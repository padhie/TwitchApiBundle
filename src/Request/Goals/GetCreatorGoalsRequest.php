<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Goals;

use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Goals\GetCreatorGoalsResponse;

/**
 * Scope: -
 */
final readonly class GetCreatorGoalsRequest implements RequestInterface
{
    public function __construct(private string $broadcasterId)
    {
    }

    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getUrl(): string
    {
        return 'https://api.twitch.tv/helix/goals';
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
        return GetCreatorGoalsResponse::class;
    }
}