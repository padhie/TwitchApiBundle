<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Channels;

use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\NoneResponse;

/**
 * Scope: channel:manage:broadcast
 */
final readonly class ModifyChannelInformationRequest implements RequestInterface
{
    public function __construct(private string $broadcasterId, private ?string $gameId = null, private ?string $broadcasterLanguage = null, private ?string $title = null, private ?int $delay = null)
    {
    }

    public function getMethod(): string
    {
        return RequestInterface::METHOD_PATCH;
    }

    public function getUrl(): string
    {
        return 'https://api.twitch.tv/helix/channels';
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getParameter(): array
    {
        return [
            'broadcaster_id' => $this->broadcasterId,
        ];
    }

    public function getBody(): array
    {
        return [
            'game_id' => $this->gameId,
            'broadcaster_language' => $this->broadcasterLanguage,
            'title' => $this->title,
            'delay' => $this->delay,
        ];
    }

    public function getResponseClass(): string
    {
        return NoneResponse::class;
    }
}