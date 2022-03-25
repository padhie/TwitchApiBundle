<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Goals;

use DateTimeImmutable;
use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class Goal implements ResponseInterface
{
    private string $id;
    private string $broadcasterId;
    private string $broadcasterName;
    private string $broadcasterLogin;
    private string $type;
    private string $description;
    private int $currentAmount;
    private int $targetAmount;
    private string $createdAt;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->id = $data['id'];
        $self->broadcasterId = $data['broadcaster_id'];
        $self->broadcasterName = $data['broadcaster_name'];
        $self->broadcasterLogin = $data['broadcaster_login'];
        $self->type = $data['type'];
        $self->description = $data['description'];
        $self->currentAmount = $data['current_amount'];
        $self->targetAmount = $data['target_amount'];
        $self->createdAt = $data['created_at'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'broadcasterId' => $this->broadcasterId,
            'broadcasterName' => $this->broadcasterName,
            'broadcasterLogin' => $this->broadcasterLogin,
            'type' => $this->type,
            'description' => $this->description,
            'currentAmount' => $this->currentAmount,
            'targetAmount' => $this->targetAmount,
            'createdAt' => $this->createdAt,
        ];
    }

    public function getId(): string
    {
        return $this->id;
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

    public function getType(): string
    {
        return $this->type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCurrentAmount(): int
    {
        return $this->currentAmount;
    }

    public function getTargetAmount(): int
    {
        return $this->targetAmount;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->createdAt);
    }
}