<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Users;

use DateTimeImmutable;
use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class FollowerUser implements ResponseInterface
{
    private string $fromId;
    private string $fromLogin;
    private string $fromName;
    private string $toId;
    private string $toName;
    private string $followedAt;

    /**
     * @inheritDoc
     */
    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->fromId = $data['from_id'];
        $self->fromLogin = $data['from_login'];
        $self->fromName = $data['from_name'];
        $self->toId = $data['to_id'];
        $self->toName = $data['to_name'];
        $self->followedAt = $data['followed_at'];

        return $self;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            'fromId' => $this->fromId,
            'fromLogin' => $this->fromLogin,
            'fromName' => $this->fromName,
            'toId' => $this->toId,
            'toName' => $this->toName,
            'followedAt' => $this->followedAt,
        ];
    }

    public function getFromId(): string
    {
        return $this->fromId;
    }

    public function getFromLogin(): string
    {
        return $this->fromLogin;
    }

    public function getFromName(): string
    {
        return $this->fromName;
    }

    public function getToId(): string
    {
        return $this->toId;
    }

    public function getToName(): string
    {
        return $this->toName;
    }

    public function getFollowedAt(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->followedAt);
    }
}