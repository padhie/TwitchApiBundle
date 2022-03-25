<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Channels;

use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\NoneResponse;

/**
 * Scope: channel:manage:broadcast
 */
final class ModifyChannelInformationRequest implements RequestInterface
{
    private string $broadcasterId;
    private ?string $gameId;
    private ?string $broadcasterLanguage;
    private ?string $title;
    private ?int $delay;

    public function __construct(string $broadcasterId, ?string $gameId = null, ?string $broadcasterLanguage = null, ?string $title = null, ?int $delay = null)
    {
        $this->broadcasterId = $broadcasterId;
        $this->gameId = $gameId;
        $this->broadcasterLanguage = $broadcasterLanguage;
        $this->title = $title;
        $this->delay = $delay;
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