<?php

namespace TwitchApiBundle\Model;

class TwitchVideo
{

    /**
     * @var integer
     */
    private $_id;

    /**
     * @var integer
     */
    private $broadcast_id;

    /**
     * @var string
     */
    private $broadcast_type;

    /**
     * @var TwitchChannel
     */
    private $channel;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $description_html;

    /**
     * @var array
     */
    private $fps;

    /**
     * @var string
     */
    private $game;

    /**
     * @var string
     */
    private $language;

    /**
     * @var integer
     */
    private $length;

    /**
     * @var array
     */
    private $muted_segments;

    /**
     * @var array
     */
    private $preview;

    /**
     * @var \DateTime
     */
    private $published_at;

    /**
     * @var array
     */
    private $resolutions;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $tag_list;

    /**
     * @var array
     */
    private $thubnails;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $viewable;

    /**
     * @var \DateTime
     */
    private $viewable_at;

    /**
     * @var integer
     */
    private $views;

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
     * @return int
     */
    public function getBroadcastId(): int
    {
        return $this->broadcast_id;
    }

    /**
     * @param int $broadcast_id
     *
     * @return $this
     */
    public function setBroadcastId(int $broadcast_id): self
    {
        $this->broadcast_id = $broadcast_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getBroadcastType(): string
    {
        return $this->broadcast_type;
    }

    /**
     * @param string $broadcast_type
     *
     * @return $this
     */
    public function setBroadcastType(string $broadcast_type): self
    {
        $this->broadcast_type = $broadcast_type;

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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescriptionHtml(): string
    {
        return $this->description_html;
    }

    /**
     * @param string $description_html
     *
     * @return $this
     */
    public function setDescriptionHtml(string $description_html): self
    {
        $this->description_html = $description_html;

        return $this;
    }

    /**
     * @return array
     */
    public function getFps(): array
    {
        return $this->fps;
    }

    /**
     * @param array $fps
     *
     * @return $this
     */
    public function setFps(array $fps): self
    {
        $this->fps = $fps;

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
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     *
     * @return $this
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     *
     * @return $this
     */
    public function setLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return array
     */
    public function getMutedSegments(): array
    {
        return $this->muted_segments;
    }

    /**
     * @param array $muted_segments
     *
     * @return $this
     */
    public function setMutedSegments(array $muted_segments): self
    {
        $this->muted_segments = $muted_segments;

        return $this;
    }

    /**
     * @return array
     */
    public function getPreview(): array
    {
        return $this->preview;
    }

    /**
     * @param array $preview
     *
     * @return $this
     */
    public function setPreview(array $preview): self
    {
        $this->preview = $preview;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublishedAt(): \DateTime
    {
        return $this->published_at;
    }

    /**
     * @param \DateTime $published_at
     *
     * @return $this
     */
    public function setPublishedAt(\DateTime $published_at): self
    {
        $this->published_at = $published_at;

        return $this;
    }

    /**
     * @return array
     */
    public function getResolutions(): array
    {
        return $this->resolutions;
    }

    /**
     * @param array $resolutions
     *
     * @return $this
     */
    public function setResolutions(array $resolutions): self
    {
        $this->resolutions = $resolutions;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getTagList(): string
    {
        return $this->tag_list;
    }

    /**
     * @param string $tag_list
     *
     * @return $this
     */
    public function setTagList(string $tag_list): self
    {
        $this->tag_list = $tag_list;

        return $this;
    }

    /**
     * @return array
     */
    public function getThubnails(): array
    {
        return $this->thubnails;
    }

    /**
     * @param array $thubnails
     *
     * @return $this
     */
    public function setThubnails(array $thubnails): self
    {
        $this->thubnails = $thubnails;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getViewable(): string
    {
        return $this->viewable;
    }

    /**
     * @param string $viewable
     *
     * @return $this
     */
    public function setViewable(string $viewable): self
    {
        $this->viewable = $viewable;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getViewableAt(): \DateTime
    {
        return $this->viewable_at;
    }

    /**
     * @param \DateTime $viewable_at
     *
     * @return $this
     */
    public function setViewableAt(\DateTime $viewable_at): self
    {
        $this->viewable_at = $viewable_at;

        return $this;
    }

    /**
     * @return int
     */
    public function getViews(): int
    {
        return $this->views;
    }

    /**
     * @param int $views
     *
     * @return $this
     */
    public function setViews(int $views): self
    {
        $this->views = $views;

        return $this;
    }
}