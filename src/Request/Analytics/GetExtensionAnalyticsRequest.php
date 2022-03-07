<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Analytics;

use DateTimeImmutable;
use Padhie\TwitchApiBundle\Request\PaginationRequestInterface;
use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Analytics\GetExtensionAnalyticsResponse;

/**
 * Scope: analytics:read:extensions
 */
final class GetExtensionAnalyticsRequest implements PaginationRequestInterface
{
    public const TYPE_OVERVIEW_V2 = 'overview_v2';

    private ?string $after = null;
    private ?string $extensionId = null;
    private ?string $type = null;
    private ?DateTimeImmutable $startedAt = null;
    private ?DateTimeImmutable $endedAt = null;

    public function withAfter(string $after): PaginationRequestInterface
    {
        $self = clone $this;
        $self->after = $after;

        return $self;
    }

    public function withExtensionId(string $extensionId): PaginationRequestInterface
    {
        $self = clone $this;
        $self->extensionId = $extensionId;

        return $self;
    }

    public function withType(string $type): PaginationRequestInterface
    {
        $self = clone $this;
        $self->type = $type;

        return $self;
    }

    public function withStartedAt(DateTimeImmutable $startedAt): PaginationRequestInterface
    {
        $self = clone $this;
        $self->startedAt = $startedAt;

        return $self;
    }

    public function withEndedAt(DateTimeImmutable $endedAt): PaginationRequestInterface
    {
        $self = clone $this;
        $self->endedAt = $endedAt;

        return $self;
    }

    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getHost(): string
    {
        return RequestInterface::HOST_HELIX;
    }

    public function getUrl(): string
    {
        return '/analytics/extensions';
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getParameter(): array
    {
        return [];
    }

    public function getBody(): array
    {
        return array_filter([
            'first' => 100,
            'after' => $this->after,
            'extension_id' => $this->extensionId,
            'started_at' => $this->startedAt->format('Y-m-d\TH:i:s\Z'),
            'ended_at' => $this->endedAt->format('Y-m-d\TH:i:s\Z'),
            'type' => $this->type,
        ]);
    }

    public function getResponseClass(): string
    {
        return GetExtensionAnalyticsResponse::class;
    }
}