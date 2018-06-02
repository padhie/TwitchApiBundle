<?php

namespace TwitchApiBundle\Model;

class TwitchFollower extends TwitchModel
{
    /**
     * @var \DateTime
     */
    private $created_at;
    /**
     * @var boolean
     */
    private $notifications;
    /**
     * @var TwitchUser
     */
    private $user;

    /**
     * @var TwitchChannel
     */
    private $channel;

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
     * @return bool
     */
    public function isNotifications(): bool
    {
        return $this->notifications;
    }

    /**
     * @param bool $notifications
     *
     * @return $this
     */
    public function setNotifications(bool $notifications): self
    {
        $this->notifications = $notifications;

        return $this;
    }

    /**
     * @return TwitchUser
     */
    public function getUser(): TwitchUser
    {
        return $this->user;
    }

    /**
     * @param TwitchUser $user
     *
     * @return $this
     */
    public function setUser(TwitchUser $user): self
    {
        $this->user = $user;

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
    
}