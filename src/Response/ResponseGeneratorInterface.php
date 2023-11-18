<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response;

use Padhie\TwitchApiBundle\Request\RequestInterface;

interface ResponseGeneratorInterface
{
    public function generateFromString(RequestInterface $request, string $response): ResponseInterface;

    public function generateErrorResponseFromException(\Throwable $exception): ErrorResponse;

    /**
     * @param array<mixed> $response
     */
    public function generateFromArray(RequestInterface $request, array $response): ResponseInterface;
}