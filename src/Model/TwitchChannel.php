<?php

namespace TwitchApiBundle\Model;

class TwitchChannel extends TwitchModel
{
    /**
     * @var boolean
     */
    private $mature;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $broadcaster_language;

    /**
     * @var string
     */
    private $display_name;

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
    private $_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var boolean
     */
    private $partner;

    /**
     * @var string
     */
    private $logo;

    /**
     * @var string|null
     */
    private $video_banner;

    /**
     * @var string|null
     */
    private $profile_banner;

    /**
     * @var string|null
     */
    private $profile_banner_background_color;

    /**
     * @var string
     */
    private $url;

    /**
     * @var integer
     */
    private $views;

    /**
     * @var integer
     */
    private $followers;


    /**
     * @return bool
     */
    public function isMature(): bool
    {
        return $this->mature;
    }

    /**
     * @param bool $mature
     *
     * @return $this
     */
    public function setMature(bool $mature): self
    {
        $this->mature = $mature;

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
    public function getBroadcasterLanguage(): string
    {
        return $this->broadcaster_language;
    }

    /**
     * @param string $broadcaster_language
     *
     * @return $this
     */
    public function setBroadcasterLanguage(string $broadcaster_language): self
    {
        $this->broadcaster_language = $broadcaster_language;

        return $this;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->display_name;
    }

    /**
     * @param string $display_name
     *
     * @return $this
     */
    public function setDisplayName(string $display_name): self
    {
        $this->display_name = $display_name;

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
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * @param int $_id
     *
     * @return $this
     */
    public function setId(int $_id): self
    {
        $this->_id = $_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

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
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    /**
     * @param \DateTime $updated_at
     *
     * @return $this
     */
    public function setUpdatedAt(\DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPartner(): bool
    {
        return $this->partner;
    }

    /**
     * @param bool $partner
     *
     * @return $this
     */
    public function setPartner(bool $partner): self
    {
        $this->partner = $partner;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     *
     * @return $this
     */
    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVideoBanner(): ?string
    {
        return $this->video_banner;
    }

    /**
     * @param string|null $video_banner
     *
     * @return $this
     */
    public function setVideoBanner(?string $video_banner): self
    {
        $this->video_banner = $video_banner;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProfileBanner(): ?string
    {
        return $this->profile_banner;
    }

    /**
     * @param string $profile_banner
     *
     * @return $this
     */
    public function setProfileBanner(?string $profile_banner): self
    {
        $this->profile_banner = $profile_banner;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProfileBannerBackgroundColor(): ?string
    {
        return $this->profile_banner_background_color;
    }

    /**
     * @param string|null $profile_banner_background_color
     *
     * @return $this
     */
    public function setProfileBannerBackgroundColor(?string $profile_banner_background_color): self
    {
        $this->profile_banner_background_color = $profile_banner_background_color;

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

    /**
     * @return int
     */
    public function getFollowers(): int
    {
        return $this->followers;
    }

    /**
     * @param int $followers
     *
     * @return $this
     */
    public function setFollowers(int $followers): self
    {
        $this->followers = $followers;

        return $this;
    }
}