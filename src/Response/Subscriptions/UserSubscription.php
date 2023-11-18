<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Subscriptions;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class UserSubscription implements ResponseInterface
{
    private string $broadcasterId;
    private string $broadcasterName;
    private string $broadcasterLogin;
    private bool $isGift;
    private ?string $gifterLogin = null;
    private ?string $gifterName = null;
    private string $tier;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->broadcasterId = $data['broadcaster_id'];
        $self->broadcasterName = $data['broadcaster_name'];
        $self->broadcasterLogin = $data['broadcaster_login'];
        $self->isGift = $data['is_gift'];
        $self->gifterLogin = $data['gifter_login'] ?? null;
        $self->gifterName = $data['gifter_name'] ?? null;
        $self->tier = $data['tier'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'broadcasterId' => $this->broadcasterId,
            'broadcasterName' => $this->broadcasterName,
            'broadcasterLogin' => $this->broadcasterLogin,
            'isGift' => $this->isGift,
            'gifterLogin' => $this->gifterLogin,
            'gifterName' => $this->gifterName,
            'tier' => $this->tier,
        ];
    }

    public function getBroadcasterId(): string
    {
        return $this->broadcasterId;
    }

    public function getBroadcasterName(): string
    {
        return $this->broadcasterName;
    }

    public function getBroadcasterLogin(): string
    {
        return $this->broadcasterLogin;
    }

    public function isGift(): bool
    {
        return $this->isGift;
    }

    public function getGifterLogin(): ?string
    {
        return $this->gifterLogin;
    }

    public function getGifterName(): ?string
    {
        return $this->gifterName;
    }

    public function getTier(): string
    {
        return $this->tier;
    }
}