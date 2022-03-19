<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Users;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class User implements ResponseInterface
{
    private string $broadcasterType;
    private string $description;
    private string $displayName;
    private string $id;
    private string $login;
    private string $offlineImageUrl;
    private string $profileImageUrl;
    private string $type;
    private int $viewCount;
    private string $createdAt;
    private ?string $email = null;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->broadcasterType = $data['broadcaster_type'];
        $self->description = $data['description'];
        $self->displayName = $data['display_name'];
        $self->id = $data['id'];
        $self->login = $data['login'];
        $self->offlineImageUrl = $data['offline_image_url'];
        $self->profileImageUrl = $data['profile_image_url'];
        $self->type = $data['type'];
        $self->viewCount = $data['view_count'];
        $self->createdAt = $data['created_at'];
        $self->email = $data['email'] ?? null;

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'broadcasterType' => $this->broadcasterType,
            'description' => $this->description,
            'displayName' => $this->displayName,
            'id' => $this->id,
            'login' => $this->login,
            'offlineImageUrl' => $this->offlineImageUrl,
            'profileImageUrl' => $this->profileImageUrl,
            'type' => $this->type,
            'viewCount' => $this->viewCount,
            'createdAt' => $this->createdAt,
            'email' => $this->email,
        ];
    }

    public function getBroadcasterType(): string
    {
        return $this->broadcasterType;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getOfflineImageUrl(): string
    {
        return $this->offlineImageUrl;
    }

    public function getProfileImageUrl(): string
    {
        return $this->profileImageUrl;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getViewCount(): int
    {
        return $this->viewCount;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
}