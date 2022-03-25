<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Authenticator;

use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Authenticator\ValidateResponse;

/**
 * Scope: -
 */
final class ValidateRequest implements RequestInterface
{
    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getUrl(): string
    {
        return 'https://id.twitch.tv/oauth2/validate';
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getParameter(): array
    {
        return [];
    }

    public function getBody(): array
    {
        return [];
    }

    public function getResponseClass(): string
    {
        return ValidateResponse::class;
    }
}