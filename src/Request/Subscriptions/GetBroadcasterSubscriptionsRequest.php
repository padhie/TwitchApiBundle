<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Subscriptions;

use Padhie\TwitchApiBundle\Request\PaginationRequestInterface;
use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Subscriptions\GetBroadcasterSubscriptionsResponse;

/**
 * Scope: channel:read:subscriptions
 */
final class GetBroadcasterSubscriptionsRequest implements PaginationRequestInterface
{
    private string $broadcasterId;
    private ?string $after = null;

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
        return 'https://api.twitch.tv/helix/subscriptions';
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
        ];
    }

    public function getBody(): array
    {
        return [];
    }

    public function getResponseClass(): string
    {
        return GetBroadcasterSubscriptionsResponse::class;
    }

    public function withAfter(string $after): PaginationRequestInterface
    {
        $self = clone $this;
        $self->after = $after;

        return $self;
    }
}