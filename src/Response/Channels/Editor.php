<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Channels;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class Editor implements ResponseInterface
{
    private string $userId;
    private string $userName;
    private string $createdAt;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->userId = $data['user_id'];
        $self->userName = $data['user_name'];
        $self->createdAt = $data['created_at'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'userId' => $this->userId,
            'userName' => $this->userName,
            'createdAt' => $this->createdAt,
        ];
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}