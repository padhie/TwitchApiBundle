<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Moderation;

use Padhie\TwitchApiBundle\Request\PaginationRequestInterface;
use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Moderation\GetBannedUsersResponse;

/**
 * Scope: moderation:read
 */
final class GetBannedUsersRequest implements PaginationRequestInterface
{
    private string $broadcasterId;
    private ?string $after = null;
    private ?string $first = null;
    private ?string $before = null;

    public function __construct(string $broadcasterId)
    {
        $this->broadcasterId = $broadcasterId;
    }

    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getUrl(): string
    {
        return 'https://api.twitch.tv/helix/moderation/banned';
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getParameter(): array
    {
        return [
            'broadcaster_id' => $this->broadcasterId,
            'after' => $this->after,
            'first' => $this->first,
            'before' => $this->before,
        ];
    }

    public function getBody(): array
    {
        return [];
    }

    public function getResponseClass(): string
    {
        return GetBannedUsersResponse::class;
    }

    public function withAfter(string $after): self
    {
        $self = clone $this;
        $self->after = $after;

        return $self;
    }

    public function withFirst(string $first): self
    {
        $self = clone $this;
        $self->first = $first;

        return $self;
    }

    public function withBefore(string $before): self
    {
        $self = clone $this;
        $self->before = $before;

        return $self;
    }
}