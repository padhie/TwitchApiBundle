<?php

namespace Padhie\TwitchApiBundle\Model;

use DateTime;

final class TwitchVideo implements TwitchModelInterface
{
    /** @var string */
    private $_id;
    /** @var int */
    private $broadcastId;
    /** @var string */
    private $broadcastType;
    /** @var TwitchChannel */
    private $channel;
    /** @var DateTime */
    private $createdAt;
    /** @var string */
    private $description;
    /** @var string */
    private $descriptionHtml;
    /** @var TwitchVideoFps */
    private $fps;
    /** @var string */
    private $game;
    /** @var string */
    private $language;
    /** @var int */
    private $length;
    /** @var array<int, TwitchVideoMutedSegment> */
    private $mutedSegments;
    /** @var TwitchVideoPreview|null */
    private $preview;
    /** @var DateTime */
    private $publishedAt;
    /** @var TwitchVideoResolutions|null */
    private $resolutions;
    /** @var string */
    private $status;
    /** @var string */
    private $tagList;
    /** @var TwitchVideoThumbnails */
    private $thumbnails;
    /** @var string */
    private $title;
    /** @var string */
    private $url;
    /** @var string */
    private $viewable;
    /** @var DateTime|null */
    private $viewableAt;
    /** @var int */
    private $views;

    /**
     * @param array<int, TwitchVideoMutedSegment> $mutedSegments
     */
    private function __construct(
        string $_id,
        int $broadcastId,
        string $broadcastType,
        TwitchChannel $channel,
        DateTime $createdAt,
        string $description,
        string $descriptionHtml,
        TwitchVideoFps $fps,
        string $game,
        string $language,
        int $length,
        array $mutedSegments,
        ?TwitchVideoPreview $preview,
        DateTime $publishedAt,
        ?TwitchVideoResolutions $resolutions,
        string $status,
        string $tagList,
        TwitchVideoThumbnails $thumbnails,
        string $title,
        string $url,
        string $viewable,
        ?DateTime $viewableAt,
        int $views
    ) {
        $this->_id = $_id;
        $this->broadcastId = $broadcastId;
        $this->broadcastType = $broadcastType;
        $this->channel = $channel;
        $this->createdAt = $createdAt;
        $this->description = $description;
        $this->descriptionHtml = $descriptionHtml;
        $this->fps = $fps;
        $this->game = $game;
        $this->language = $language;
        $this->length = $length;
        $this->mutedSegments = $mutedSegments;
        $this->preview = $preview;
        $this->publishedAt = $publishedAt;
        $this->resolutions = $resolutions;
        $this->status = $status;
        $this->tagList = $tagList;
        $this->thumbnails = $thumbnails;
        $this->title = $title;
        $this->url = $url;
        $this->viewable = $viewable;
        $this->viewableAt = $viewableAt;
        $this->views = $views;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchVideo
    {
        $mutedSegments = [];
        foreach ($json['muted_segments'] ?? [] as $mutedSegment) {
            $mutedSegments[] = TwitchVideoMutedSegment::createFromJson($mutedSegment);
        }

        return new self(
            $json['_id'] ?? '',
            $json['broadcast_id'] ?? 0,
            $json['broadcast_type'] ?? '',
            TwitchChannel::createFromJson($json['channel']),
            new DateTime($json['created_at']),
            $json['description'] ?? '',
            $json['description_html'] ?? '',
            TwitchVideoFps::createFromJson($json['fps']),
            $json['game'] ?? '',
            $json['language'] ?? '',
            $json['length'] ?? 0,
            $mutedSegments,
            isset($json['preview']) ? TwitchVideoPreview::createFromJson($json['preview']) : null,
            new DateTime($json['published_at']),
            isset($json['resolutions']) ? TwitchVideoResolutions::createFromJson($json['resolutions']) : null,
            $json['status'] ?? '',
            $json['tag_list'] ?? '',
            TwitchVideoThumbnails::createFromJson($json['thumbnails']),
            $json['title'] ?? '',
            $json['url'] ?? '',
            $json['viewable'] ?? '',
            isset($json['viewable_at']) ? new DateTime($json['viewable_at']) : null,
            $json['views'] ?? 0
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getId(): string
    {
        return $this->_id;
    }

    public function getBroadcastId(): int
    {
        return $this->broadcastId;
    }

    public function getBroadcastType(): string
    {
        return $this->broadcastType;
    }

    public function getChannel(): TwitchChannel
    {
        return $this->channel;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDescriptionHtml(): string
    {
        return $this->descriptionHtml;
    }

    public function getFps(): TwitchVideoFps
    {
        return $this->fps;
    }

    public function getGame(): string
    {
        return $this->game;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @return array<int, TwitchVideoMutedSegment>
     */
    public function getMutedSegments(): array
    {
        return $this->mutedSegments;
    }

    public function getPreview(): ?TwitchVideoPreview
    {
        return $this->preview;
    }

    public function getPublishedAt(): DateTime
    {
        return $this->publishedAt;
    }

    public function getResolutions(): ?TwitchVideoResolutions
    {
        return $this->resolutions;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getTagList(): string
    {
        return $this->tagList;
    }

    public function getThumbnails(): TwitchVideoThumbnails
    {
        return $this->thumbnails;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getViewable(): string
    {
        return $this->viewable;
    }

    public function getViewableAt(): ?DateTime
    {
        return $this->viewableAt;
    }

    public function getViews(): int
    {
        return $this->views;
    }
}