<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Videos;

use Padhie\TwitchApiBundle\Exception\InvalidRequestException;
use Padhie\TwitchApiBundle\Request\PaginationRequestInterface;
use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Videos\GetVideoResponse;

/**
 * Scope: -
 */
final class GetVideoRequest implements PaginationRequestInterface
{
    private ?string $id;
    private ?string $userId;
    private ?string $gameId;
    private ?string $after = null;
    private ?string $before = null;
    private ?string $first = null;
    private ?string $language = null;
    private ?string $period = null;
    private ?string $sort = null;
    private ?string $type = null;

    public function __construct(?string $id = null, ?string $userId = null, ?string $gameId = null)
    {
        if ($id === null && $userId === null && $gameId === null) {
            throw new InvalidRequestException('This request need \'id\' OR \'user_id\' OR \'game_id\'.');
        }

        $this->id = $id;
        $this->userId = $userId;
        $this->gameId = $gameId;
    }

    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getUrl(): string
    {
        return 'https://api.twitch.tv/helix/videos';
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getParameter(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->userId,
            'game_id' => $this->gameId,
            'after' => $this->after,
            'before' => $this->before,
            'first' => $this->first,
            'language' => $this->language,
            'period' => $this->period,
            'sort' => $this->sort,
            'type' => $this->type,
        ];
    }

    public function getBody(): array
    {
        return [];
    }

    public function getResponseClass(): string
    {
        return GetVideoResponse::class;
    }

    public function withAfter(string $after): PaginationRequestInterface
    {
        $self = clone $this;
        $self->after = $after;

        return $self;
    }

    public function withBefore(string $before): PaginationRequestInterface
    {
        $self = clone $this;
        $self->before = $before;

        return $self;
    }

    public function withFirst(string $first): PaginationRequestInterface
    {
        $self = clone $this;
        $self->first = $first;

        return $self;
    }

    public function withLanguage(string $language): PaginationRequestInterface
    {
        $self = clone $this;
        $self->language = $language;

        return $self;
    }

    public function withPeriod(string $period): PaginationRequestInterface
    {
        $self = clone $this;
        $self->period = $period;

        return $self;
    }

    public function withSort(string $sort): PaginationRequestInterface
    {
        $self = clone $this;
        $self->sort = $sort;

        return $self;
    }

    public function withType(string $type): PaginationRequestInterface
    {
        $self = clone $this;
        $self->type = $type;

        return $self;
    }
}