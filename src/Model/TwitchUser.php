<?php

namespace Padhie\TwitchApiBundle\Model;

use DateTime;

final class TwitchUser implements TwitchModelInterface
{
    /** @var int */
    private $_id;
    /** @var string */
    private $displayName;
    /** @var string */
    private $name;
    /** @var string */
    private $type;
    /** @var string|null */
    private $bio;
    /** @var DateTime */
    private $createdAt;
    /** @var DateTime */
    private $updatedAt;
    /** @var null|string */
    private $logo;
    /** @var null|TwitchUserNotifications */
    private $notifications;
    /** @var string */
    private $email;
    /** @var bool */
    private $email_verified;
    /** @var bool */
    private $partnered;
    /** @var bool */
    private $twitter_connected;

    private function __construct(
        int $_id,
        ?string $bio,
        string $displayName,
        ?string $logo,
        string $name,
        string $type,
        DateTime $createdAt,
        DateTime $updatedAt,
        ?TwitchUserNotifications $notifications,
        string $email,
        bool $email_verified,
        bool $partnered,
        bool $twitter_connected
    ){
        $this->_id = $_id;
        $this->bio = $bio;
        $this->displayName = $displayName;
        $this->logo = $logo;
        $this->name = $name;
        $this->type = $type;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->notifications = $notifications;
        $this->email = $email;
        $this->email_verified = $email_verified;
        $this->partnered = $partnered;
        $this->twitter_connected = $twitter_connected;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchUser
    {
        return new self(
            $json['_id'] ?? 0,
            $json['bio'] ?? '',
            $json['display_name'] ?? '',
            $json['logo'] ?? '',
            $json['name'] ?? '',
            $json['type'] ?? '',
            $json['created_at'] ? new DateTime($json['created_at']) : new $json['created_at'],
            $json['updated_at'] ? new DateTime($json['updated_at']) : new $json['updated_at'],
            $json['notifications'] ? TwitchUserNotifications::createFromJson($json['notifications']) : null,
            $json['email'] ?? '',
            $json['email_verified'] ?? false,
            $json['partnered'] ?? false,
            $json['twitter_connected'] ?? false
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getId(): int
    {
        return $this->_id;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function getNotifications(): ?TwitchUserNotifications
    {
        return $this->notifications;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function isEmailVerified(): bool
    {
        return $this->email_verified;
    }

    public function isPartnered(): bool
    {
        return $this->partnered;
    }

    public function isTwitterConnected(): bool
    {
        return $this->twitter_connected;
    }
}