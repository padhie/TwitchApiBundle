<?php

namespace Padhie\TwitchApiBundle\Model;

final class TwitchChannel implements TwitchModelInterface
{
    private string $broadcasterId;
    private string $broadcasterLogin;
    private string $broadcasterName;
    private string $broadcasterLanguage;
    private string $gameId;
    private string $gameName;
    private string $title;
    private int $delay;

    private function __construct()
    {}

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchChannel
    {
        $self = new self();

        $self->broadcasterId = $json["broadcaster_id"];
        $self->broadcasterLogin = $json["broadcaster_login"];
        $self->broadcasterName = $json["broadcaster_name"];
        $self->broadcasterLanguage = $json["broadcaster_language"];
        $self->gameId = $json["game_id"];
        $self->gameName = $json["game_name"];
        $self->title = $json["title"];
        $self->delay = $json["delay"];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
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