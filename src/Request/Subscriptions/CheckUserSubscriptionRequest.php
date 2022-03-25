<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Subscriptions;

use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Subscriptions\CheckUserSubscriptionResponse;

/**
 * Scope: user:read:subscriptions
 */
final class CheckUserSubscriptionRequest implements RequestInterface
{
    private string $broadcasterId;
    private string $userId;

    public function __construct(string $broadcasterId, string $userId)
    {
        $this->broadcasterId = $broadcasterId;
        $this->userId = $userId;
    }

    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getUrl(): string
    {
        return 'https://api.twitch.tv/helix/subscriptions/user';
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getParameter(): array
    {
        return [
            'broadcaster_id' => $this->broadcasterId,
            'user_id' => $this->userId,
        ];
    }

    public function getBody(): array
    {
        return [];
    }

    public function getResponseClass(): string
    {
        return CheckUserSubscriptionResponse::class;
    }
}