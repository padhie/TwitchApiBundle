<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Streams;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetStreamsResponse implements ResponseInterface
{
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
    private string $tagIds;
    private string $isMature;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach ($data['data'] as $item) {
            $self->id = $item['id'];
            $self->userId = $item['user_id'];
            $self->userLogin = $item['user_login'];
            $self->gameId = $item['game_id'];
            $self->gameName = $item['game_name'];
            $self->type = $item['type'];
            $self->title = $item['title'];
            $self->viewerCount = (int) $item['viewer_count'];
            $self->startedAt = $item['started_at'];
            $self->language = $item['language'];
            $self->thumbnailUrl = $item['thumbnail_url'];
            $self->tagIds = $item['tag_ids'];
            $self->isMature = $item['is_mature'];
        }

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

    public function getStartedAt(): string
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

    public function getTagIds(): string
    {
        return $this->tagIds;
    }

    public function getIsMature(): string
    {
        return $this->isMature;
    }
}