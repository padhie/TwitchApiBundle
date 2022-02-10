<?php

namespace Padhie\TwitchApiBundle\Model;

use DateTimeImmutable;

final class TwitchStream implements TwitchModelInterface
{
    private string $id;
    private string $userId;
    private string $userLogin;
    private string $userName;
    private string $gameId;
    private string $gameName;
    private string $type;
    private string $title;
    private int $viewerCount;
    private DateTimeImmutable $startedAt;
    private string $language;
    private string $thumbnailUrl;
    /** @var array<int, string> */
    private array $tagIds = [];
    private bool $isMature;

    private function __construct()
    {}

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchStream
    {
        $self = new self();

        $self->id = $json['id'];
        $self->userId = $json['user_id'];
        $self->userLogin = $json['user_login'];
        $self->userName = $json['user_name'];
        $self->gameId = $json['game_id'];
        $self->gameName = $json['game_name'];
        $self->type = $json['type'];
        $self->title = $json['title'];
        $self->viewerCount = $json['viewer_count'];
        $self->startedAt = new DateTimeImmutable($json['started_at']);
        $self->language = $json['language'];
        $self->thumbnailUrl = $json['thumbnail_url'];
        $self->tagIds = $json['tag_ids'];
        $self->isMature = $json['is_mature'];

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

    public function getGameId(): string
    {
        return $this->gameId;
    }

    public function getGameName(): string
    {
        return $this->gameName;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getViewerCount(): int
    {
        return $this->viewerCount;
    }

    public function getStartedAt(): DateTimeImmutable
    {
        return $this->startedAt;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getThumbnailUrl(): string
    {
        return $this->thumbnailUrl;
    }

    /**
     * @return array<int, string>
     */
    public function getTagIds(): array
    {
        return $this->tagIds;
    }

    public function isMature(): bool
    {
        return $this->isMature;
    }
}