<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Promise\Utils;
use JsonException;
use Padhie\TwitchApiBundle\Exception\InvalidRequestException;
use Padhie\TwitchApiBundle\Exception\InvalidResponseException;
use Padhie\TwitchApiBundle\Request\PaginationRequestInterface;
use Padhie\TwitchApiBundle\Request\RequestGeneratorInterface;
use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\ResponseGeneratorInterface;
use Padhie\TwitchApiBundle\Response\ResponseInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

use function array_merge;
use function count;
use function json_decode;
use function strlen;

final readonly class TwitchClient implements TwitchClientInterface
{
    private const REQUEST_READ_LIMIT = 8192;

    public function __construct(
        private ClientInterface $client,
        private RequestGeneratorInterface $requestGenerator,
        private ResponseGeneratorInterface $responseGenerator,
    ) {
    }

    /**
     * @throws InvalidRequestException
     * @throws JsonException
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        $prsRequest = $this->requestGenerator->generate($request);

        try {
            $response = $this->executeRequest($prsRequest);
        } catch (ClientException $exception) {
            return $this->responseGenerator->generateErrorResponseFromException($exception);
        }

        return $this->responseGenerator->generateFromString($request, $response);
    }

    public function sendWithPagination(PaginationRequestInterface $request): ResponseInterface
    {
        $paginationCursor = null;
        $dataCollection = [];

        do {
            if ($paginationCursor !== null) {
                $request = $request->withAfter($paginationCursor);
            }

            $prsRequest = $this->requestGenerator->generate($request);

            try {
                $responseString = $this->executeRequest($prsRequest);
            } catch (ClientException $exception) {
                return $this->responseGenerator->generateErrorResponseFromException($exception);
            }

            $jsonResponse = json_decode($responseString, true, 512, JSON_THROW_ON_ERROR);

            $dataCollection = array_merge($dataCollection, $jsonResponse['data'] ?? []);
            $paginationCursor = $jsonResponse['pagination']['cursor'] ?? null;

            if ($paginationCursor === null || count($jsonResponse['data']) === 0) {
                break;
            }

        } while(true);

        if (!is_array($jsonResponse)) {
            throw new InvalidResponseException('There is no valid pagination response.');
        }

        $jsonResponse['data'] = $dataCollection;

        return $this->responseGenerator->generateFromArray($request, $jsonResponse);
    }

    /**
     * @param array<int|string, RequestInterface> $requests
     * @return array<int|string, ResponseInterface|null> key is related to request
     *
     * @throws InvalidRequestException
     * @throws JsonException
     */
    public function sendAsync(array $requests): array
    {
        $promises = $responses = [];

        foreach ($requests as $key => $request) {
            $prsRequest = $this->requestGenerator->generate($request);

            $promise = $this->client->sendAsync($prsRequest);
            $promise->then(
                function($response) use ($request, $key, &$responses): void {
                    $responseString = $this->loadBody($response);
                    $responses[$key] = $this->responseGenerator->generateFromString($request, $responseString);
                },
                function($response) use ($key, &$responses): void {
                    $responses[$key] = $response instanceof \Throwable
                        ? $this->responseGenerator->generateErrorResponseFromException($response)
                        : null;
                }
            );

            $promises[$key] = $promise;
        }

        Utils::unwrap($promises);

        return $responses;
    }

    private function executeRequest(PsrRequestInterface $request): string
    {
        $response = $this->client->send($request);
        $responseString = $this->loadBody($response);

        return $responseString === ''
            ? '{}'
            : $responseString;
    }

    private function loadBody(PsrResponseInterface $response): string
    {
        $responseString = '';

        $check = true;
        while ($check) {
            $tmpResponseString = $response->getBody()->read(self::REQUEST_READ_LIMIT);
            $responseString .= $tmpResponseString;
            if (strlen($tmpResponseString) < self::REQUEST_READ_LIMIT) {
                $check = false;
            }
        }

        return $responseString;
    }
}