<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Channels;

use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Channels\GetChannelInformationResponse;

final class GetChannelInformationRequest implements RequestInterface
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

    public function getUrl(): string
    {
        return 'https://api.twitch.tv/helix/channels';
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
        return GetChannelInformationResponse::class;
    }
}