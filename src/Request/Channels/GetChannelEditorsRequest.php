<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Channels;

use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Channels\GetChannelEditorsResponse;

/**
 * Scope: channel:read:editors
 */
final class GetChannelEditorsRequest implements RequestInterface
{
    private string $broadcasterId;

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
        return 'https://api.twitch.tv/helix/channels/editors';
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
        return GetChannelEditorsResponse::class;
    }
}