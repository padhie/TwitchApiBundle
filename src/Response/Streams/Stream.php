<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Streams;

use DateTimeImmutable;
use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class Stream implements ResponseInterface
{
    public const TYPE_LIVE = 'live';

    private string $id;
    private string $userId;
    private string $userLogin;
    private string $gameId;
    private string $gameName;
    private string $type;
    private string $title;
    private int $viewerCount;
    private string $startedAt;
    private string $language;
    private string $thumbnailUrl;
    /** @var array<int, string> */
    private array $tagIds = [];
    private bool $isMature;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->id = $data['id'];
        $self->userId = $data['user_id'];
        $self->userLogin = $data['user_login'];
        $self->gameId = $data['game_id'];
        $self->gameName = $data['game_name'];
        $self->type = $data['type'];
        $self->title = $data['title'];
        $self->viewerCount = (int) $data['viewer_count'];
        $self->startedAt = $data['started_at'];
        $self->language = $data['language'];
        $self->thumbnailUrl = $data['thumbnail_url'];
        $self->tagIds = $data['tag_ids'];
        $self->isMature = (bool) $data['is_mature'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->userId,
            'userLogin' => $this->userLogin,
            'gameId' => $this->gameId,
            'gameName' => $this->gameName,
            'type' => $this->type,
            'title' => $this->title,
            'viewerCount' => $this->viewerCount,
            'startedAt' => $this->startedAt,
            'language' => $this->language,
            'thumbnailUrl' => $this->thumbnailUrl,
            'tagIds' => $this->tagIds,
            'isMature' => $this->isMature,
        ];
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
        return new DateTimeImmutable($this->startedAt);
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

    public function getIsMature(): bool
    {
        return $this->isMature;
    }

    public function isLive(): bool
    {
        return $this->type === self::TYPE_LIVE;
    }
}