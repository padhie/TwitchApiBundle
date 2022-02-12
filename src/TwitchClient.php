<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle;

use GuzzleHttp\ClientInterface;
use JsonException;
use Padhie\TwitchApiBundle\Exception\InvalidRequestException;
use Padhie\TwitchApiBundle\Exception\InvalidResponseException;
use Padhie\TwitchApiBundle\Request\PaginationRequestInterface;
use Padhie\TwitchApiBundle\Request\RequestGenerator;
use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\ResponseInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use function call_user_func;
use function strlen;

final class TwitchClient
{
    private const REQUEST_READ_LIMIT = 8192;

    private ClientInterface $client;
    private RequestGenerator $requestGenerator;

    public function __construct(ClientInterface $client, RequestGenerator $requestGenerator)
    {
        $this->client = $client;
        $this->requestGenerator = $requestGenerator;
    }

    /**
     * @throws InvalidRequestException
     * @throws JsonException
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        $clientRequest = $this->requestGenerator->generate($request);
        $responseString = $this->executeRequest($clientRequest);

        return call_user_func(
            [$request->getResponseClass(), 'createFromArray'],
            json_decode($responseString, true, 512, JSON_THROW_ON_ERROR)
        );
    }

    public function sendWithPagination(PaginationRequestInterface $request): ResponseInterface
    {
        $paginationCursor = null;
        $dataCollection = [];

        do {
            if ($paginationCursor !== null) {
                $request = $request->withAfter($paginationCursor);
            }

            $clientRequest = $this->requestGenerator->generate($request);
            $responseString = $this->executeRequest($clientRequest);
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

        return call_user_func(
            [$request->getResponseClass(), 'createFromArray'],
            $jsonResponse
        );
    }

    private function executeRequest(PsrRequestInterface $request): string
    {
        $response = $this->client->send($request);

        return $this->loadBody($response);
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