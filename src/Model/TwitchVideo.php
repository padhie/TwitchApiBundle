<?php

namespace Padhie\TwitchApiBundle\Model;

use DateTime;

class TwitchVideo extends TwitchModel
{

    /** @var string */
    private $_id;
    /** @var integer */
    private $broadcast_id;
    /** @var string */
    private $broadcast_type;
    /** @var TwitchChannel */
    private $channel;
    /** var DateTime */
    private $created_at;
    /** @var string */
    private $description;
    /** @var string */
    private $description_html;
    /**
     * @var array
     */
    private $fps;
    /** @var string */
    private $game;
    /** @var string */
    private $language;
    /** @var integer */
    private $length;
    /**
     * @var array
     */
    private $muted_segments = [];
    /** @var array */
    private $preview;
    /** var DateTime */
    private $published_at;
    /**
     * @var array
     */
    private $resolutions;
    /** @var string */
    private $status;
    /** @var string */
    private $tag_list;
    /** TwitchVideoThumbnail[] */
    private $thumbnails = [];
    /** @var string */
    private $title;
    /** @var string */
    private $url;
    /** @var string */
    private $viewable;
    /** var DateTime */
    private $viewable_at;
    /** @var integer */
    private $views;

    public function getId(): string
    {
        return $this->_id;
    }

    public function setId(string $id): self
    {
        $this->_id = $id;

        return $this;
    }

    public function getBroadcastId(): int
    {
        return $this->broadcast_id;
    }

    public function setBroadcastId(int $broadcast_id): self
    {
        $this->broadcast_id = $broadcast_id;

        return $this;
    }

    public function getBroadcastType(): string
    {
        return $this->broadcast_type;
    }

    public function setBroadcastType(string $broadcast_type): self
    {
        $this->broadcast_type = $broadcast_type;

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

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescriptionHtml(): string
    {
        return $this->description_html;
    }

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

    public function setFps(array $fps): self
    {
        $this->fps = $fps;

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

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getLength(): int
    {
        return $this->length;
    }

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

    public function setMutedSegments(array $muted_segments): self
    {
        $this->muted_segments = $muted_segments;

        return $this;
    }

    public function addMutedSegment(TwitchVideoMutedSegments $muted_segment): self
    {
        $this->muted_segments[] = $muted_segment;

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
     */
    public function setPreview(array $preview): self
    {
        $this->preview = $preview;

        return $this;
    }

    public function getPublishedAt(): DateTime
    {
        return $this->published_at;
    }

    public function setPublishedAt(DateTime $published_at): self
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
     */
    public function setResolutions(array $resolutions): self
    {
        $this->resolutions = $resolutions;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTagList(): string
    {
        return $this->tag_list;
    }

    public function setTagList(string $tag_list): self
    {
        $this->tag_list = $tag_list;

        return $this;
    }

    /**
     * @return TwitchVideoThumbnail[]
     */
    public function getThumbnails(): array
    {
        return $this->thumbnails;
    }

    /**
     * @param TwitchVideoThumbnail[] $thumbnails
     */
    public function setThumbnails(array $thumbnails): self
    {
        $this->thumbnails = $thumbnails;

        return $this;
    }

    public function addThumbnail(string $type, TwitchVideoThumbnail $thumbnail): self
    {
        $this->thumbnails[$type] = $thumbnail;

        return $this;
    }

    /**
     * @param TwitchVideoThumbnail[]  $thumbnails
     */
    public function addThumbnails(string $type, array $thumbnails): self
    {
        foreach ($thumbnails AS $thumbnail) {
            $this->addThumbnail($type, $thumbnail);
        }

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getViewable(): string
    {
        return $this->viewable;
    }

    public function setViewable(string $viewable): self
    {
        $this->viewable = $viewable;

        return $this;
    }

    public function getViewableAt(): DateTime
    {
        return $this->viewable_at;
    }

    public function setViewableAt(DateTime $viewable_at): self
    {
        $this->viewable_at = $viewable_at;

        return $this;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function setViews(int $views): self
    {
        $this->views = $views;

        return $this;
    }
}