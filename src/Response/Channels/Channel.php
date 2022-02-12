<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Channels;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class Channel implements ResponseInterface
{
    private string $broadcasterId;
    private string $broadcasterLogin;
    private string $broadcasterName;
    private string $broadcasterLanguage;
    private string $gameId;
    private string $gameName;
    private string $title;
    private int $delay;

    public static function createFromArray(array $data): ResponseInterface
    {
        $self = new self();

        $self->broadcasterId = $data['broadcaster_id'];
        $self->broadcasterLogin = $data['broadcaster_login'];
        $self->broadcasterName = $data['broadcaster_name'];
        $self->broadcasterLanguage = $data['broadcaster_language'];
        $self->gameId = $data['game_id'];
        $self->gameName = $data['game_name'];
        $self->title = $data['title'];
        $self->delay = $data['delay'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'broadcasterId' => $this->broadcasterId,
            'broadcasterLogin' => $this->broadcasterLogin,
            'broadcasterName' => $this->broadcasterName,
            'broadcasterLanguage' => $this->broadcasterLanguage,
            'gameId' => $this->gameId,
            'gameName' => $this->gameName,
            'title' => $this->title,
            'delay' => $this->delay,
        ];
    }

    public function getBroadcasterId(): string
    {
        return $this->broadcasterId;
    }

    public function getBroadcasterLogin(): string
    {
        return $this->broadcasterLogin;
    }

    public function getBroadcasterName(): string
    {
        return $this->broadcasterName;
    }

    public function getBroadcasterLanguage(): string
    {
        return $this->broadcasterLanguage;
    }

    public function getGameId(): string
    {
        return $this->gameId;
    }

    public function getGameName(): string
    {
        return $this->gameName;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDelay(): int
    {
        return $this->delay;
    }
}