<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Channels;

use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Channels\GetChannelResponse;

final class GetChannelRequest implements RequestInterface
{
    private int $broadcasterId;

    public function __construct(int $broadcasterId)
    {
        $this->broadcasterId = $broadcasterId;
    }

    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getHost(): string
    {
        return RequestInterface::HOST_HELIX;
    }

    public function getUrl(): string
    {
        return '/channels';
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
        return GetChannelResponse::class;
    }
}