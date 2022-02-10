<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Model;

class TwitchBanedUser implements TwitchModelInterface
{
    /** @var string */
    private $user_id;
    /** @var string */
    private $user_login;
    /** @var string */
    private $user_name;
    /** @var null|string */
    private $expires_at;
    /** @var null|string */
    private $reason;
    /** @var string */
    private $moderator_id;
    /** @var string */
    private $moderator_login;
    /** @var string */
    private $moderator_name;

    private function __construct(
        string $user_id,
        string $user_login,
        string $user_name,
        ?string $expires_at,
        ?string $reason,
        string $moderator_id,
        string $moderator_login,
        string $moderator_name
    ) {
        $this->user_id = $user_id;
        $this->user_login = $user_login;
        $this->user_name = $user_name;
        $this->expires_at = $expires_at;
        $this->reason = $reason;
        $this->moderator_id = $moderator_id;
        $this->moderator_login = $moderator_login;
        $this->moderator_name = $moderator_name;
    }

    public static function createFromJson(array $json): self
    {
        return new self(
            $json['user_id'],
            $json['user_login'],
            $json['user_name'],
            $json['expires_at'] !== '' ? $json['expires_at'] : null,
            $json['reason'] !== '' ? $json['reason'] : null,
            $json['moderator_id'],
            $json['moderator_login'],
            $json['moderator_name']
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }

    public function getUserLogin(): string
    {
        return $this->user_login;
    }

    public function getUserName(): string
    {
        return $this->user_name;
    }

    public function getExpiresAt(): ?string
    {
        return $this->expires_at;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function getModeratorId(): string
    {
        return $this->moderator_id;
    }

    public function getModeratorLogin(): string
    {
        return $this->moderator_login;
    }

    public function getModeratorName(): string
    {
        return $this->moderator_name;
    }
}