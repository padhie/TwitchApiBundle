<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Videos;

use DateTimeImmutable;
use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class Video implements ResponseInterface
{
    private string $id;
    private string $streamId;
    private string $userId;
    private string $userLogin;
    private string $userName;
    private string $title;
    private string $description;
    private string $createdAt;
    private string $publishedAt;
    private string $url;
    private string $thumbnailUrl;
    private string $viewable;
    private int $viewCount;
    private string $language;
    private string $type;
    private string $duration;
    /** @var array<int, MutedSegments> */
    private array $mutedSegments = [];

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->id = $data['id'];
        $self->streamId = $data['stream_id'];
        $self->userId = $data['user_id'];
        $self->userLogin = $data['user_login'];
        $self->userName = $data['user_name'];
        $self->title = $data['title'];
        $self->description = $data['description'];
        $self->createdAt = $data['created_at'];
        $self->publishedAt = $data['published_at'];
        $self->url = $data['url'];
        $self->thumbnailUrl = $data['thumbnail_url'];
        $self->viewable = $data['viewable'];
        $self->viewCount = $data['view_count'];
        $self->language = $data['language'];
        $self->type = $data['type'];
        $self->duration = $data['duration'];

        foreach ($data['muted_segments'] ?? [] as $muted_segment) {
            $self->mutedSegments[] = MutedSegments::createFromArray($muted_segment);
        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'streamId' => $this->streamId,
            'userId' => $this->userId,
            'userLogin' => $this->userLogin,
            'userName' => $this->userName,
            'title' => $this->title,
            'description' => $this->description,
            'createdAt' => $this->createdAt,
            'publishedAt' => $this->publishedAt,
            'url' => $this->url,
            'thumbnailUrl' => $this->thumbnailUrl,
            'viewable' => $this->viewable,
            'viewCount' => $this->viewCount,
            'language' => $this->language,
            'type' => $this->type,
            'duration' => $this->duration,
            'mutedSegments' => $this->mutedSegments,
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getStreamId(): string
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
        return new DateTimeImmutable($this->createdAt);
    }

    public function getPublishedAt(): string
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
     * @return array<int, MutedSegments>
     */
    public function getMutedSegments(): array
    {
        return $this->mutedSegments;
    }
}