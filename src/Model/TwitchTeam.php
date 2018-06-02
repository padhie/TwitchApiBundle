<?php

namespace TwitchApiBundle\Model;

class TwitchTeam
{
    /**
     * @var integer
     */
    private $_id;
    /**
     * @var string
     */
    private $background;
    /**
     * @var string
     */
    private $banner;
    /**
     * @var \DateTime
     */
    private $created_at;
    /**
     * @var string
     */
    private $display_name;
    /**
     * @var string
     */
    private $info;
    /**
     * @var string
     */
    private $logo;
    /**
     * @var string
     */
    private $name;
    /**
     * @var \DateTime
     */
    private $updated_at;

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
    public function getBackground(): string
    {
        return $this->background;
    }

    /**
     * @param string $background
     *
     * @return $this
     */
    public function setBackground(string $background): self
    {
        $this->background = $background;

        return $this;
    }

    /**
     * @return string
     */
    public function getBanner(): string
    {
        return $this->banner;
    }

    /**
     * @param string $banner
     *
     * @return $this
     */
    public function setBanner(string $banner): self
    {
        $this->banner = $banner;

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
    public function getInfo(): string
    {
        return $this->info;
    }

    /**
     * @param string $info
     *
     * @return $this
     */
    public function setInfo(string $info): self
    {
        $this->info = $info;

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
}