<?php

namespace Padhie\TwitchApiBundle\Model;

use DateTime;

class TwitchStream extends TwitchModel
{
    /** @var integer */
    private $_id;
    /** @var string */
    private $game;
    /** @var integer */
    private $viewers;
    /** @var integer */
    private $video_height;
    /** @var integer */
    private $average_fps;
    /** @var integer */
    private $delay;
    /** @var DateTime */
    private $created_at;
    /** @var boolean */
    private $is_playlist;
    /** @var string[] */
    private $preview;
    /** @var TwitchChannel */
    private $channel;

    public function getId(): int
    {
        return $this->_id;
    }

    public function setId(int $id): self
    {
        $this->_id = $id;

        return $this;
    }

    public function getGame(): string
    {
        return $this->game;
    }

    public function setGame(string $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getViewers(): int
    {
        return $this->viewers;
    }

    public function setViewers(int $viewers): self
    {
        $this->viewers = $viewers;

        return $this;
    }

    public function getVideoHeight(): int
    {
        return $this->video_height;
    }

    public function setVideoHeight(int $video_height): self
    {
        $this->video_height = $video_height;

        return $this;
    }

    public function getAverageFps(): int
    {
        return $this->average_fps;
    }

    public function setAverageFps(int $average_fps): self
    {
        $this->average_fps = $average_fps;

        return $this;
    }

    public function getDelay(): int
    {
        return $this->delay;
    }

    public function setDelay(int $delay): self
    {
        $this->delay = $delay;

        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function isPlaylist(): bool
    {
        return $this->is_playlist;
    }

    public function setIsPlaylist(bool $is_playlist): self
    {
        $this->is_playlist = $is_playlist;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getPreview(): array
    {
        return $this->preview;
    }

    /**
     * @param string[] $preview
     */
    public function setPreview(array $preview): self
    {
        $this->preview = $preview;

        return $this;
    }

    public function getChannel(): TwitchChannel
    {
        return $this->channel;
    }

    public function setChannel(TwitchChannel $channel): self
    {
        $this->channel = $channel;

        return $this;
    }
}