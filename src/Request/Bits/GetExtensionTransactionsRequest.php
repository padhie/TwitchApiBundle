<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Bits;

use Padhie\TwitchApiBundle\Request\PaginationRequestInterface;
use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Bits\GetExtensionTransactionsResponse;

/**
 * Scope: -
 */
final class GetExtensionTransactionsRequest implements PaginationRequestInterface
{
    private string $extensionId;
    private ?string $id = null;
    private ?string $after = null;
    private ?string $first = null;

    public function __construct(string $extensionId)
    {
        $this->extensionId = $extensionId;
    }

    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getUrl(): string
    {
        return 'https://api.twitch.tv/helix/extensions/transactions';
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getParameter(): array
    {
        return [
            'extension_id' => $this->extensionId,
            'after' => $this->after,
            'id' => $this->id,
            'first' => $this->first,
        ];
    }

    public function getBody(): array
    {
        return [];
    }

    public function getResponseClass(): string
    {
        return GetExtensionTransactionsResponse::class;
    }

    public function withAfter(string $after): self
    {
        $self = clone $this;
        $self->after = $after;

        return $self;
    }

    public function withId(string $id): self
    {
        $self = clone $this;
        $self->id = $id;

        return $self;
    }

    public function withFirst(string $first): self
    {
        $self = clone $this;
        $self->first = $first;

        return $self;
    }
}