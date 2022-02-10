<?php

namespace Padhie\TwitchApiBundle\Model;

use DateTimeImmutable;

final class TwitchTeam implements TwitchModelInterface
{
    private string $broadcasterId;
    private string $broadcasterName;
    private string $broadcasterLogin;
    private ?string $backgroundImageUrl;
    private ?string $banner;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;
    private string $info;
    private string $thumbnailUrl;
    private string $teamName;
    private string $teamDisplayName;
    private string $id;

    private function __construct()
    {
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchTeam
    {
        $self = new self();

        $self->broadcasterId = $json['broadcaster_id'];
        $self->broadcasterName = $json['broadcaster_name'];
        $self->broadcasterLogin = $json['broadcaster_login'];
        $self->backgroundImageUrl = $json['background_image_url'] ?? null;
        $self->banner = $json['banner'] ?? null;
        $self->createdAt = new DateTimeImmutable($json['created_at']);
        $self->updatedAt = new DateTimeImmutable($json['updated_at']);
        $self->info = $json['info'];
        $self->thumbnailUrl = $json['thumbnail_url'];
        $self->teamName = $json['team_name'];
        $self->teamDisplayName = $json['team_display_name'];
        $self->id = $json['id'];

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

    public function getBroadcasterName(): string
    {
        return $this->broadcasterName;
    }

    public function getBroadcasterLogin(): string
    {
        return $this->broadcasterLogin;
    }

    public function getBackgroundImageUrl(): ?string
    {
        return $this->backgroundImageUrl;
    }

    public function getBanner(): ?string
    {
        return $this->banner;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getInfo(): string
    {
        return $this->info;
    }

    public function getThumbnailUrl(): string
    {
        return $this->thumbnailUrl;
    }

    public function getTeamName(): string
    {
        return $this->teamName;
    }

    public function getTeamDisplayName(): string
    {
        return $this->teamDisplayName;
    }

    public function getId(): string
    {
        return $this->id;
    }
}