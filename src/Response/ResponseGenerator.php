<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response;

use Padhie\TwitchApiBundle\Request\RequestInterface;

use function call_user_func;
use function json_decode;

final class ResponseGenerator
{
    public function generateFromString(RequestInterface $request, string $response): ResponseInterface
    {
        $response = $response !== '' ? $response : '{}';
        $jsonResponse = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

        return $this->generateFromArray($request, $jsonResponse);
    }

    public function generateFromArray(RequestInterface $request, array $response): ResponseInterface
    {
        $responseClass = $request->getResponseClass();

        return call_user_func(
            [$responseClass, 'createFromArray'],
            $response
        );
    }
}