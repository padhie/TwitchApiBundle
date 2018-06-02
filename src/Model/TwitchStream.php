<?php

namespace TwitchApiBundle\Model;

class TwitchStream
{
    /**
     * @var integer
     */
    private $_id;

    /**
     * @var string
     */
    private $game;

    /**
     * @var integer
     */
    private $viewers;

    /**
     * @var integer
     */
    private $video_height;

    /**
     * @var integer
     */
    private $average_fps;

    /**
     * @var integer
     */
    private $delay;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var boolean
     */
    private $is_playlist;

    /**
     * @var string[]
     */
    private $preview;

    /**
     * @var TwitchChannel
     */
    private $channel;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId(int $id): self
    {
        $this->_id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getGame(): string
    {
        return $this->game;
    }

    /**
     * @param string $game
     *
     * @return $this
     */
    public function setGame(string $game): self
    {
        $this->game = $game;

        return $this;
    }

    /**
     * @return int
     */
    public function getViewers(): int
    {
        return $this->viewers;
    }

    /**
     * @param int $viewers
     *
     * @return $this
     */
    public function setViewers(int $viewers): self
    {
        $this->viewers = $viewers;

        return $this;
    }

    /**
     * @return int
     */
    public function getVideoHeight(): int
    {
        return $this->video_height;
    }

    /**
     * @param int $video_height
     *
     * @return $this
     */
    public function setVideoHeight(int $video_height): self
    {
        $this->video_height = $video_height;

        return $this;
    }

    /**
     * @return int
     */
    public function getAverageFps(): int
    {
        return $this->average_fps;
    }

    /**
     * @param int $average_fps
     *
     * @return $this
     */
    public function setAverageFps(int $average_fps): self
    {
        $this->average_fps = $average_fps;

        return $this;
    }

    /**
     * @return int
     */
    public function getDelay(): int
    {
        return $this->delay;
    }

    /**
     * @param int $delay
     *
     * @return $this
     */
    public function setDelay(int $delay): self
    {
        $this->delay = $delay;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $created_at
     *
     * @return $this
     */
    public function setCreatedAt(\DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPlaylist(): bool
    {
        return $this->is_playlist;
    }

    /**
     * @param bool $is_playlist
     *
     * @return $this
     */
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
     *
     * @return $this
     */
    public function setPreview(array $preview): self
    {
        $this->preview = $preview;

        return $this;
    }

    /**
     * @return TwitchChannel
     */
    public function getChannel(): TwitchChannel
    {
        return $this->channel;
    }

    /**
     * @param TwitchChannel $channel
     *
     * @return $this
     */
    public function setChannel(TwitchChannel $channel): self
    {
        $this->channel = $channel;

        return $this;
    }
}