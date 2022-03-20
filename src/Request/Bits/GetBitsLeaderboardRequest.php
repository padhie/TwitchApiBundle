<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Bits;

use DateTimeImmutable;
use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Bits\GetBitsLeaderboardResponse;

/**
 * Scope: bits:read
 */
final class GetBitsLeaderboardRequest implements RequestInterface
{
    private ?int $count = null;
    private ?string $period = null;
    private ?string $startedAt = null;
    private ?string $userId = null;

    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getUrl(): string
    {
        return 'https://api.twitch.tv/helix/bits/leaderboard';
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getParameter(): array
    {
        return [
            'count' => $this->count,
            'period' => $this->period,
            'started_at' => $this->startedAt,
            'user_id' => $this->userId,
        ];
    }

    public function getBody(): array
    {
        return [];
    }

    public function getResponseClass(): string
    {
        return GetBitsLeaderboardResponse::class;
    }

    public function withCount(int $count): self
    {
        $self = clone $this;
        $self->count = $count;

        return $self;
    }

    public function withPeriod(string $period): self
    {
        $self = clone $this;
        $self->period = $period;

        return $self;
    }

    public function withStartedAt(DateTimeImmutable $startedAt): self
    {
        $self = clone $this;
        $self->startedAt = $startedAt->format('Y-m-d\TH:i:s\Z');

        return $self;
    }

    public function withUserId(string $userId): self
    {
        $self = clone $this;
        $self->userId = $userId;

        return $self;
    }
}