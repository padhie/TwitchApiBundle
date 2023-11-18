<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Users;

use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Users\GetUsersResponse;

/**
 * Scope: -/user:read:email
 */
final readonly class GetUsersRequest implements RequestInterface
{
    public function __construct(private ?string $id = null, private ?string $login = null)
    {
    }

    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getUrl(): string
    {
        return 'https://api.twitch.tv/helix/users';
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getParameter(): array
    {
        return [
            'id' => $this->id,
            'login' => $this->login,
        ];
    }

    public function getBody(): array
    {
        return [];
    }

    public function getResponseClass(): string
    {
        return GetUsersResponse::class;
    }
}