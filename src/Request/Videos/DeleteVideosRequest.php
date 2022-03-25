<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Videos;

use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\NoneResponse;

/**
 * Scope: channel:manage:videos
 */
final class DeleteVideosRequest implements RequestInterface
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getMethod(): string
    {
        return RequestInterface::METHOD_DELETE;
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
        ];
    }

    public function getBody(): array
    {
        return [];
    }

    public function getResponseClass(): string
    {
        return NoneResponse::class;
    }
}