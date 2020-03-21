<?php

namespace Padhie\TwitchApiBundle\Model;

use DateTime;

final class TwitchChannel implements TwitchModelInterface
{
    /** @var bool */
    private $mature;
    /** @var string */
    private $status;
    /** @var string */
    private $broadcasterLanguage;
    /** @var string */
    private $displayName;
    /** @var string */
    private $game;
    /** @var string */
    private $language;
    /** @var string */
    private $_id;
    /** @var string */
    private $name;
    /** @var DateTime */
    private $createdAt;
    /** @var DateTime */
    private $updatedAt;
    /** @var bool */
    private $partner;
    /** @var string */
    private $logo;
    /** @var string|null */
    private $videoBanner;
    /** @var string|null */
    private $profileBanner;
    /** @var string|null */
    private $profileBannerBackgroundColor;
    /** @var string */
    private $url;
    /** @var int */
    private $views;
    /** @var int */
    private $followers;
    /** @var string */
    private $broadcasterType;
    /** @var string */
    private $stream_key;
    /** @var string */
    private $email;

    private function __construct(
        bool $mature,
        string $status,
        string $broadcasterLanguage,
        string $displayName,
        string $game,
        string $language,
        string $_id,
        string $name,
        DateTime $createdAt,
        DateTime $updatedAt,
        bool $partner,
        string $logo,
        ?string $videoBanner,
        ?string $profileBanner,
        ?string $profileBannerBackgroundColor,
        string $url,
        int $views,
        int $followers,
        string $broadcasterType,
        string $stream_key,
        string $email
    )
    {
        $this->mature = $mature;
        $this->status = $status;
        $this->broadcasterLanguage = $broadcasterLanguage;
        $this->displayName = $displayName;
        $this->game = $game;
        $this->language = $language;
        $this->_id = $_id;
        $this->name = $name;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->partner = $partner;
        $this->logo = $logo;
        $this->videoBanner = $videoBanner;
        $this->profileBanner = $profileBanner;
        $this->profileBannerBackgroundColor = $profileBannerBackgroundColor;
        $this->url = $url;
        $this->views = $views;
        $this->followers = $followers;
        $this->broadcasterType = $broadcasterType;
        $this->stream_key = $stream_key;
        $this->email = $email;
    }

    public static function createFromJson(array $json): TwitchChannel
    {
        return new self(
            $json['mature'] ?? false,
            $json['status'] ?? '',
            $json['broadcaster_language'] ?? '',
            $json['display_name'] ?? '',
            $json['game'] ?? '',
            $json['language'] ?? '',
            $json['_id'] ?? '',
            $json['name'] ?? '',
            $json['created_at'] ? new DateTime($json['created_at']) : new DateTime(),
            $json['updated_at'] ? new DateTime($json['updated_at']) : new DateTime(),
            $json['partner'] ?? false,
            $json['logo'] ?? '',
            $json['video_banner'] ?? null,
            $json['profile_banner'] ?? null,
            $json['profile_banner_background_color'] ?? null,
            $json['url'] ?? '',
            $json['views'] ?? 0,
            $json['followers'] ?? 0,
            $json['broadcaster_type'] ?? '',
            $json['stream_key'] ?? '',
            $json['email'] ?? ''
        );
    }

    public function isMature(): bool
    {
        return $this->mature;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getBroadcasterLanguage(): string
    {
        return $this->broadcasterLanguage;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function getGame(): string
    {
        return $this->game;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getId(): string
    {
        return $this->_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function isPartner(): bool
    {
        return $this->partner;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function getVideoBanner(): ?string
    {
        return $this->videoBanner;
    }

    public function getProfileBanner(): ?string
    {
        return $this->profileBanner;
    }

    public function getProfileBannerBackgroundColor(): ?string
    {
        return $this->profileBannerBackgroundColor;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function getFollowers(): int
    {
        return $this->followers;
    }

    public function getBroadcasterType(): string
    {
        return $this->broadcasterType;
    }

    public function getStreamKey(): string
    {
        return $this->stream_key;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

}