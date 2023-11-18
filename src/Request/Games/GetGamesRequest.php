<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Games;

use Padhie\TwitchApiBundle\Request\PaginationRequestInterface;
use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Games\GetGamesResponse;

/**
 * Scope: -
 */
final class GetGamesRequest implements PaginationRequestInterface
{
    private ?string $after = null;

    public function __construct(private ?string $id = null, private ?string $name = null)
    {
    }

    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getUrl(): string
    {
        return 'https://api.twitch.tv/helix/games';
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getParameter(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'after' => $this->after,
        ];
    }

    public function getBody(): array
    {
        return [];
    }

    public function getResponseClass(): string
    {
        return GetGamesResponse::class;
    }

    public function withAfter(string $after): PaginationRequestInterface
    {
        $self = clone $this;
        $self->after = $after;

        return $self;
    }
}