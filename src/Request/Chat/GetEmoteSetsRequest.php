<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Chat;

use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Chat\GetEmoteSetsResponse;

/**
 * Scope: -
 */
final readonly class GetEmoteSetsRequest implements RequestInterface
{
    public function __construct(private string $emoteSetId)
    {
    }

    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getUrl(): string
    {
        return 'https://api.twitch.tv/helix/chat/emotes/set';
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getParameter(): array
    {
        return [
            'emote_set_id' => $this->emoteSetId,
        ];
    }

    public function getBody(): array
    {
        return [];
    }

    public function getResponseClass(): string
    {
        return GetEmoteSetsResponse::class;
    }
}