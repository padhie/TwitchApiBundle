<?php

namespace TwitchApiBundle\Model;

use DateTime;

class TwitchTeam extends TwitchModel
{
    /** @var integer */
    private $_id;
    /** @var string */
    private $background;
    /** @var string */
    private $banner;
    /** @var DateTime */
    private $created_at;
    /** @var string */
    private $display_name;
    /** @var string */
    private $info;
    /** @var string */
    private $logo;
    /** @var string */
    private $name;
    /** @var DateTime */
    private $updated_at;

    public function getId(): int
    {
        return $this->_id;
    }

    public function setId(int $id): self
    {
        $this->_id = $id;

        return $this;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(string $background): self
    {
        $this->background = $background;

        return $this;
    }

    public function getBanner(): string
    {
        return $this->banner;
    }

    public function setBanner(string $banner): self
    {
        $this->banner = $banner;

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

    public function getDisplayName(): string
    {
        return $this->display_name;
    }

    public function setDisplayName(string $display_name): self
    {
        $this->display_name = $display_name;

        return $this;
    }

    public function getInfo(): string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;

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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
}