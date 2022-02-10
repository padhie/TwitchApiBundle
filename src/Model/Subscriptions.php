<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Model;

final class Subscriptions implements TwitchModelInterface
{
    private string $broadcasterId;
    private string $broadcasterLogin;
    private string $broadcasterName;
    private string $gifterId;
    private string $gifterLogin;
    private string $gifterName;
    private bool $isGift;
    private string $tier;
    private string $planName;
    private string $userId;
    private string $userName;
    private string $userLogin;

    private function __construct()
    {}

    public static function createFromJson(array $json): self
    {
        $self = new self();

        $self->broadcasterId = $json["broadcaster_id"];
        $self->broadcasterLogin = $json["broadcaster_login"];
        $self->broadcasterName = $json["broadcaster_name"];
        $self->gifterId = $json["gifter_id"];
        $self->gifterLogin = $json["gifter_login"];
        $self->gifterName = $json["gifter_name"];
        $self->isGift = $json["is_gift"];
        $self->tier = $json["tier"];
        $self->planName = $json["plan_name"];
        $self->userId = $json["user_id"];
        $self->userName = $json["user_name"];
        $self->userLogin = $json["user_login"];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getBroadcasterId(): string
    {
        return $this->broadcasterId;
    }

    public function getBroadcasterLogin(): string
    {
        return $this->broadcasterLogin;
    }

    public function getBroadcasterName(): string
    {
        return $this->broadcasterName;
    }

    public function getGifterId(): string
    {
        return $this->gifterId;
    }

    public function getGifterLogin(): string
    {
        return $this->gifterLogin;
    }

    public function getGifterName(): string
    {
        return $this->gifterName;
    }

    public function isGift(): bool
    {
        return $this->isGift;
    }

    public function getTier(): string
    {
        return $this->tier;
    }

    public function getPlanName(): string
    {
        return $this->planName;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getUserLogin(): string
    {
        return $this->userLogin;
    }
}