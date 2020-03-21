<?php

namespace Padhie\TwitchApiBundle\Model;

use DateTime;

final class TwitchStream implements TwitchModelInterface
{
    /** @var int */
    private $_id;
    /** @var string */
    private $game;
    /** @var int */
    private $viewers;
    /** @var int */
    private $videoHeight;
    /** @var int */
    private $averageFps;
    /** @var int */
    private $delay;
    /** @var boolean */
    private $isPlaylist;
    /** @var string[] */
    private $preview;
    /** @var DateTime */
    private $createdAt;
    /** @var TwitchChannel */
    private $channel;

    private function __construct(
        int $_id,
        string $game,
        int $viewers,
        int $videoHeight,
        int $averageFps,
        int $delay,
        bool $isPlaylist,
        array $preview,
        DateTime $createdAt,
        TwitchChannel $channel
    ) {
        $this->_id = $_id;
        $this->game = $game;
        $this->viewers = $viewers;
        $this->videoHeight = $videoHeight;
        $this->averageFps = $averageFps;
        $this->delay = $delay;
        $this->isPlaylist = $isPlaylist;
        $this->preview = $preview;
        $this->createdAt = $createdAt;
        $this->channel = $channel;
    }

    public static function createFromJson(array $json): TwitchStream
    {
        return new self(
            $json['_id'] ?? 0,
            $json['game'] ?? 'string',
            $json['viewers'] ?? 0,
            $json['video_height'] ?? 0,
            $json['average_fps'] ?? 0,
            $json['delay'] ?? 0,
            $json['is_playlist'] ?? false,
            $json['preview'] ?? [],
            new DateTime($json['created_at']),
            TwitchChannel::createFromJson($json['channel'])
        );
    }

    public function getId(): int
    {
        return $this->_id;
    }

    public function getGame(): string
    {
        return $this->game;
    }

    public function getViewers(): int
    {
        return $this->viewers;
    }

    public function getVideoHeight(): int
    {
        return $this->videoHeight;
    }

    public function getAverageFps(): int
    {
        return $this->averageFps;
    }

    public function getDelay(): int
    {
        return $this->delay;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function isPlaylist(): bool
    {
        return $this->isPlaylist;
    }

    /**
     * @return string[]
     */
    public function getPreview(): array
    {
        return $this->preview;
    }

    public function getChannel(): TwitchChannel
    {
        return $this->channel;
    }
}