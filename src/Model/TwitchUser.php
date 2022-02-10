<?php

namespace Padhie\TwitchApiBundle\Model;

use DateTimeImmutable;

final class TwitchUser implements TwitchModelInterface
{
    private string $id;
    private string $login;
    private string $displayName;
    private string $type;
    private string $broadcasterType;
    private string $description;
    private string $profileImageUrl;
    private string $offlineImageUrl;
    private int $viewCount;
    private string $email;
    private DateTimeImmutable $createdAt;

    private function __construct()
    {}

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchUser
    {
        $self = new self();

        $self->id = $json['id'];
        $self->login = $json['login'];
        $self->displayName = $json['display_name'];
        $self->type = $json['type'];
        $self->broadcasterType = $json['broadcaster_type'];
        $self->description = $json['description'];
        $self->profileImageUrl = $json['profile_image_url'];
        $self->offlineImageUrl = $json['offline_image_url'];
        $self->viewCount = $json['view_count'];
        $self->email = $json['email'];
        $self->createdAt = new DateTimeImmutable($json['created_at']);

        return $self;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getBroadcasterType(): string
    {
        return $this->broadcasterType;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getProfileImageUrl(): string
    {
        return $this->profileImageUrl;
    }

    public function getOfflineImageUrl(): string
    {
        return $this->offlineImageUrl;
    }

    public function getViewCount(): int
    {
        return $this->viewCount;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}