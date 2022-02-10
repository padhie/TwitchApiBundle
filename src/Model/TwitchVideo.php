<?php

namespace Padhie\TwitchApiBundle\Model;

use DateTimeImmutable;

final class TwitchVideo implements TwitchModelInterface
{
    private string $id;
    private ?string $streamId;
    private string $userId;
    private string $userLogin;
    private string $userName;
    private string $title;
    private string $description;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $publishedAt;
    private string $url;
    private string $thumbnailUrl;
    private string $viewable;
    private int $viewCount;
    private string $language;
    private string $type;
    private string $duration;
    /** @var array<int, TwitchVideoMutedSegment> */
    private array $mutedSegments = [];

    private function __construct()
    {}

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchVideo
    {
        $self = new self();

        $self->id = $json['id'];
        $self->streamId = $json['stream_id'] ?? null;
        $self->userId = $json['user_id'];
        $self->userLogin = $json['user_login'];
        $self->userName = $json['user_name'];
        $self->title = $json['title'];
        $self->description = $json['description'];
        $self->createdAt = new DateTimeImmutable($json['created_at']);
        $self->publishedAt = new DateTimeImmutable($json['published_at']);
        $self->url = $json['url'];
        $self->thumbnailUrl = $json['thumbnail_url'];
        $self->viewable = $json['viewable'];
        $self->viewCount = $json['view_count'];
        $self->language = $json['language'];
        $self->type = $json['type'];
        $self->duration = $json['duration'];

        foreach ($json['muted_segments'] as $mutedSegment) {
            $self->mutedSegments[] = TwitchVideoMutedSegment::createFromJson($mutedSegment);
        }

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

    public function getStreamId(): ?string
    {
        return $this->streamId;
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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getPublishedAt(): DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getThumbnailUrl(): string
    {
        return $this->thumbnailUrl;
    }

    public function getViewable(): string
    {
        return $this->viewable;
    }

    public function getViewCount(): int
    {
        return $this->viewCount;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }

    /**
     * @return array<int, TwitchVideoMutedSegment>
     */
    public function getMutedSegments(): array
    {
        return $this->mutedSegments;
    }
}