<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Ads;

use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Ads\StartCommercialResponse;

/**
 * Scope: channel:edit:commercial
 */
final class StartCommercialRequest implements RequestInterface
{
    private int $broadcasterId;
    private int $length;

    public function __construct(int $broadcasterId, int $length = 60)
    {
        $this->broadcasterId = $broadcasterId;
        $this->length = $length;
    }

    public function getMethod(): string
    {
        return RequestInterface::METHOD_POST;
    }

    public function getHost(): string
    {
        return RequestInterface::HOST_HELIX;
    }

    public function getUrl(): string
    {
        return '/channels/commercial';
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
        return [
            'broadcaster_id' => $this->broadcasterId,
            'length' => $this->length,
        ];
    }

    public function getResponseClass(): string
    {
        return StartCommercialResponse::class;
    }
}