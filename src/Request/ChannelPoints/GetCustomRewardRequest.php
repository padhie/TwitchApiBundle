<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\ChannelPoints;

use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\ChannelPoints\GetCustomRewardResponse;

/**
 * Scope: channel:read:redemptions
 */
final class GetCustomRewardRequest implements RequestInterface
{
    private string $broadcasterId;
    private ?string $id = null;
    private bool $onlyManageableRewards = false;

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
        return 'https://api.twitch.tv/helix/channel_points/custom_rewards';
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getParameter(): array
    {
        return [
            'broadcaster_id' => $this->broadcasterId,
            'id' => $this->id,
            'only_manageable_rewards' => $this->onlyManageableRewards,
        ];
    }

    public function getBody(): array
    {
        return [];
    }

    public function getResponseClass(): string
    {
        return GetCustomRewardResponse::class;
    }

    public function withId(string $id): self
    {
        $self = clone $this;
        $self->id = $id;

        return $self;
    }

    public function withOnlyManageableRewards(bool $onlyManageableRewards): self
    {
        $self = clone $this;
        $self->onlyManageableRewards = $onlyManageableRewards;

        return $self;
    }
}