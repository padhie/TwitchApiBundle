<?php

namespace Padhie\TwitchApiBundle\Model;

use DateTime;

class TwitchUser extends TwitchModel
{
    /** @var integer */
    private $_id;
    /** @var string */
    private $display_name;
    /** @var string */
    private $name;
    /** @var string */
    private $type;
    /** @var string|null */
    private $bio;
    /** @var DateTime */
    private $created_at;
    /** @var DateTime */
    private $updated_at;
    /** @var string */
    private $logo;
    /** @var TwitchUserNotifications */
    private $notifications;

    public function getId(): int
    {
        return $this->_id;
    }

    public function setId(int $id): self
    {
        $this->_id = $id;

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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): self
    {
        $this->bio = $bio;

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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getNotifications(): TwitchUserNotifications
    {
        return $this->notifications;
    }

    public function setNotifications(TwitchUserNotifications $notifications): self
    {
        $this->notifications = $notifications;

        return $this;
    }
}