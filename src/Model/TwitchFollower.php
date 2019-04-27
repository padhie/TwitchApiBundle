<?php

namespace TwitchApiBundle\Model;

use DateTime;

class TwitchFollower extends TwitchModel
{
    /** @var DateTime */
    private $created_at;
    /** @var boolean */
    private $notifications;
    /** @var TwitchUser */
    private $user;
    /** @var TwitchChannel */
    private $channel;

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function isNotifications(): bool
    {
        return $this->notifications;
    }

    public function setNotifications(bool $notifications): self
    {
        $this->notifications = $notifications;

        return $this;
    }

    public function getUser(): ?TwitchUser
    {
        return $this->user;
    }

    public function setUser(TwitchUser $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getChannel(): ?TwitchChannel
    {
        return $this->channel;
    }

    public function setChannel(TwitchChannel $channel): self
    {
        $this->channel = $channel;

        return $this;
    }
    
}