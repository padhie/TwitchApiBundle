<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Subscriptions;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class Subscription implements ResponseInterface
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

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->broadcasterId = $data['broadcaster_id'];
        $self->broadcasterLogin = $data['broadcaster_login'];
        $self->broadcasterName = $data['broadcaster_name'];
        $self->gifterId = $data['gifter_id'];
        $self->gifterLogin = $data['gifter_login'];
        $self->gifterName = $data['gifter_name'];
        $self->isGift = (bool) $data['is_gift'];
        $self->tier = $data['tier'];
        $self->planName = $data['plan_name'];
        $self->userId = $data['user_id'];
        $self->userName = $data['user_name'];
        $self->userLogin = $data['user_login'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'broadcasterId' => $this->broadcasterId,
            'broadcasterLogin' => $this->broadcasterLogin,
            'broadcasterName' => $this->broadcasterName,
            'gifterId' => $this->gifterId,
            'gifterLogin' => $this->gifterLogin,
            'gifterName' => $this->gifterName,
            'isGift' => $this->isGift,
            'tier' => $this->tier,
            'planName' => $this->planName,
            'userId' => $this->userId,
            'userName' => $this->userName,
            'userLogin' => $this->userLogin,
        ];
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