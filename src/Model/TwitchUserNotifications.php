<?php

namespace TwitchApiBundle\Model;

class TwitchUserNotifications extends TwitchModel
{
    /**
     * @var bool
     */
    private $email;

    /**
     * @var bool
     */
    private $push;

    /**
     * @return bool
     */
    public function isEmail(): bool
    {
        return $this->email;
    }

    /**
     * @param bool $email
     *
     * @return TwitchUserNotifications
     */
    public function setEmail(bool $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPush(): bool
    {
        return $this->push;
    }

    /**
     * @param bool $push
     *
     * @return TwitchUserNotifications
     */
    public function setPush(bool $push): self
    {
        $this->push = $push;

        return $this;
    }
}