<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Analytics;

use Padhie\TwitchApiBundle\Request\PaginationRequestInterface;
use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Analytics\GetGameAnalyticsResponse;

/**
 * Scope: analytics:read:games
 */
final class GetGameAnalyticsRequest implements PaginationRequestInterface
{
    private ?string $after = null;
    private ?string $endedAt = null;
    private ?int $first = null;
    private ?string $gameId = null;
    private ?string $startedAt = null;
    private ?string $type = null;

    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getUrl(): string
    {
        return 'https://api.twitch.tv/helix/analytics/games';
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getParameter(): array
    {
        return [
            'after' => $this->after,
            'ended_at' => $this->endedAt,
            'first' => $this->first,
            'game_id' => $this->gameId,
            'started_at' => $this->startedAt,
            'type' => $this->type,
        ];
    }

    public function getBody(): array
    {
        return [];
    }

    public function getResponseClass(): string
    {
        return GetGameAnalyticsResponse::class;
    }

    public function withAfter(string $after): self
    {
        $self = clone $this;
        $self->after = $after;

        return $self;
    }

    public function withEndedAt(string $endedAt): self
    {
        $self = clone $this;
        $self->endedAt = $endedAt;

        return $self;
    }

    public function withFirst(int $first): self
    {
        $self = clone $this;
        $self->first = $first;

        return $self;
    }

    public function withGameId(string $gameId): self
    {
        $self = clone $this;
        $self->gameId = $gameId;

        return $self;
    }

    public function withStartedAt(string $startedAt): self
    {
        $self = clone $this;
        $self->startedAt = $startedAt;

        return $self;
    }

    public function withType(string $type): self
    {
        $self = clone $this;
        $self->type = $type;

        return $self;
    }
}