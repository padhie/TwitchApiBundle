<?php

namespace Padhie\TwitchApiBundle\Model;

use DateTime;

class TwitchChannel extends TwitchModel
{
    /** @var boolean */
    private $mature;
    /** @var string */
    private $status;
    /** @var string */
    private $broadcaster_language;
    /** @var string */
    private $display_name;
    /** @var string */
    private $game;
    /** @var string */
    private $language;
    /** @var integer */
    private $_id;
    /** @var string */
    private $name;
    /** @var DateTime */
    private $created_at;
    /** @var DateTime */
    private $updated_at;
    /** @var boolean */
    private $partner;
    /** @var string */
    private $logo;
    /** @var string|null */
    private $video_banner;
    /** @var string|null */
    private $profile_banner;
    /** @var string|null */
    private $profile_banner_background_color;
    /** @var string */
    private $url;
    /** @var integer */
    private $views;
    /** @var integer */
    private $followers;

    public function isMature(): bool
    {
        return $this->mature;
    }

    public function setMature(bool $mature): self
    {
        $this->mature = $mature;

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

    public function getBroadcasterLanguage(): string
    {
        return $this->broadcaster_language;
    }

    public function setBroadcasterLanguage(string $broadcaster_language): self
    {
        $this->broadcaster_language = $broadcaster_language;

        return $this;
    }

    public function getDisplayName(): string
    {
        return $this->display_name;
    }

    public function setDisplayName(string $display_name): self
    {
        $this->display_name = $display_name;

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

    public function getId(): int
    {
        return $this->_id;
    }

    public function setId(int $_id): self
    {
        $this->_id = $_id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function isPartner(): bool
    {
        return $this->partner;
    }

    public function setPartner(bool $partner): self
    {
        $this->partner = $partner;

        return $this;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getVideoBanner(): ?string
    {
        return $this->video_banner;
    }

    public function setVideoBanner(?string $video_banner): self
    {
        $this->video_banner = $video_banner;

        return $this;
    }

    public function getProfileBanner(): ?string
    {
        return $this->profile_banner;
    }

    public function setProfileBanner(?string $profile_banner): self
    {
        $this->profile_banner = $profile_banner;

        return $this;
    }

    public function getProfileBannerBackgroundColor(): ?string
    {
        return $this->profile_banner_background_color;
    }

    public function setProfileBannerBackgroundColor(?string $profile_banner_background_color): self
    {
        $this->profile_banner_background_color = $profile_banner_background_color;

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

    public function getViews(): int
    {
        return $this->views;
    }

    public function setViews(int $views): self
    {
        $this->views = $views;

        return $this;
    }

    public function getFollowers(): int
    {
        return $this->followers;
    }

    public function setFollowers(int $followers): self
    {
        $this->followers = $followers;

        return $this;
    }
}