<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Ads;

use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Ads\StartCommercialResponse;

/**
 * Scope: channel:edit:commercial
 */
final readonly class StartCommercialRequest implements RequestInterface
{
    public function __construct(private int $broadcasterId, private int $length = 60)
    {
    }

    public function getMethod(): string
    {
        return RequestInterface::METHOD_POST;
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