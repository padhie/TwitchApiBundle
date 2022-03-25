<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Moderation;

use DateTimeImmutable;
use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class BannedUser implements ResponseInterface
{
    private string $userId;
    private string $userLogin;
    private string $userName;
    private string $expiresAt;
    private string $reason;
    private string $moderatorId;
    private string $moderatorLogin;
    private string $moderatorName;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->userId = $data['user_id'];
        $self->userLogin = $data['user_login'];
        $self->userName = $data['user_name'];
        $self->expiresAt = $data['expires_at'];
        $self->reason = $data['reason'];
        $self->moderatorId = $data['moderator_id'];
        $self->moderatorLogin = $data['moderator_login'];
        $self->moderatorName = $data['moderator_name'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'userId' => $this->userId,
            'userLogin' => $this->userLogin,
            'userName' => $this->userName,
            'expiresAt' => $this->expiresAt,
            'reason' => $this->reason,
            'moderatorId' => $this->moderatorId,
            'moderatorLogin' => $this->moderatorLogin,
            'moderatorName' => $this->moderatorName,
        ];
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getUserLogin(): string
    {
        return $this->userLogin;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getExpiresAt(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->expiresAt);
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function getModeratorId(): string
    {
        return $this->moderatorId;
    }

    public function getModeratorLogin(): string
    {
        return $this->moderatorLogin;
    }

    public function getModeratorName(): string
    {
        return $this->moderatorName;
    }
}