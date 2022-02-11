<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle;

use GuzzleHttp\ClientInterface;
use JsonException;
use Padhie\TwitchApiBundle\Exception\InvalidRequestException;
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