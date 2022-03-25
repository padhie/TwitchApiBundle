<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Bits;

use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Bits\GetCheermotesResponse;

/**
 * Scope: -
 */
final class GetCheermotesRequest implements RequestInterface
{
    private ?string $broadcasterId = null;

    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getUrl(): string
    {
        return 'https://api.twitch.tv/helix/bits/cheermotes';
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getParameter(): array
    {
        return [
            'broadcaster_id' => $this->broadcasterId,
        ];
    }

    public function getBody(): array
    {
        return [];
    }

    public function getResponseClass(): string
    {
        return GetCheermotesResponse::class;
    }

    public function withBroadcasterId(string $broadcasterId): self
    {
        $self = new self();
        $self->broadcasterId = $broadcasterId;

        return $self;
    }
}