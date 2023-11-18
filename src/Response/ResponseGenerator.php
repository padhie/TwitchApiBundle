<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response;

use GuzzleHttp\Exception\ClientException;
use Padhie\TwitchApiBundle\Request\RequestInterface;

use function call_user_func;
use function json_decode;

final class ResponseGenerator implements ResponseGeneratorInterface
{
    public function generateFromString(RequestInterface $request, string $response): ResponseInterface
    {
        $response = $response !== '' ? $response : '{}';
        $jsonResponse = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

        if ($this->isErrorResponse($jsonResponse)) {
            return ErrorResponse::createFromArray($jsonResponse);
        }

        return $this->generateFromArray($request, $jsonResponse);
    }

    public function generateErrorResponseFromException(\Throwable $exception): ErrorResponse
    {
        if ($exception instanceof ClientException) {
            $message = $exception->getMessage();
            $posOfResponse = strpos($message, 'response:') + 9;
            $response = substr($message, $posOfResponse);
            $jsonResponse = json_decode((string) $response, true, 512, JSON_THROW_ON_ERROR);
            return ErrorResponse::createFromArray($jsonResponse);
        }

        return ErrorResponse::createFromArray([
            'error' => $exception::class,
            'status' => $exception->getCode(),
            'message' => $exception->getMessage(),
        ]);
    }

    /**
     * @param array<mixed> $response
     */
    public function generateFromArray(RequestInterface $request, array $response): ResponseInterface
    {
        $responseClass = $request->getResponseClass();

        return call_user_func(
            [$responseClass, 'createFromArray'],
            $response
        );
    }

    /**
     * @param array<mixed> $response
     */
    private function isErrorResponse(array $response): bool
    {
        return array_key_exists('error', $response)
            && !empty($response['error']);
    }
}