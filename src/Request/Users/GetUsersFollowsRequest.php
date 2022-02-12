<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Users;

use Padhie\TwitchApiBundle\Exception\InvalidRequestException;
use Padhie\TwitchApiBundle\Request\PaginationRequestInterface;
use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Users\GetUsersFollowsResponse;

final class GetUsersFollowsRequest implements PaginationRequestInterface
{
    private int $first = 1;
    private ?string $after = null;
    private ?string $fromId;
    private ?string $toId;

    public function __construct(?string $fromId=null, ?string $toId=null)
    {
        if ($fromId === null && $toId === null) {
            throw new InvalidRequestException('This request need \'from_id\' OR \'to_id\'.');
        }

        $this->fromId = $fromId;
        $this->toId = $toId;
    }

    public function withAfter(string $after): PaginationRequestInterface
    {
        $self = clone $this;
        $self->after = $after;

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
        return '/users/follows';
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getParameter(): array
    {
        return array_filter([
            'first' => $this->first,
            'after' => $this->after,
            'from_id' => $this->fromId,
            'to_id' => $this->toId,
        ]);
    }

    public function getBody(): array
    {
        return [];
    }

    public function getResponseClass(): string
    {
        return GetUsersFollowsResponse::class;
    }
}