<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Games;

use Padhie\TwitchApiBundle\Request\PaginationRequestInterface;
use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Games\GetTopGamesResponse;

/**
 * Scope: -
 */
final class GetTopGamesRequest implements PaginationRequestInterface
{
    private ?string $after = null;
    private ?string $before = null;
    private ?string $first = null;

    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getUrl(): string
    {
        return 'https://api.twitch.tv/helix/games/top';
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getParameter(): array
    {
        return [
            'after' => $this->after,
            'before' => $this->before,
            'first' => $this->first,
        ];
    }

    public function getBody(): array
    {
        return [];
    }

    public function getResponseClass(): string
    {
        return GetTopGamesResponse::class;
    }

    public function withAfter(string $after): PaginationRequestInterface
    {
        $self = clone $this;
        $self->after = $after;

        return $self;
    }

    public function withBefore(string $before): PaginationRequestInterface
    {
        $self = clone $this;
        $self->before = $before;

        return $self;
    }

    public function withFirst(string $first): PaginationRequestInterface
    {
        $self = clone $this;
        $self->first = $first;

        return $self;
    }
}