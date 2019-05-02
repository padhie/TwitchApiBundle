<?php

namespace Padhie\TwitchApiBundle\Model;

class TwitchUserNotifications extends TwitchModel
{
    /** @var bool */
    private $email;
    /** @var bool */
    private $push;

    public function isEmail(): bool
    {
        return $this->email;
    }

    public function setEmail(bool $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function isPush(): bool
    {
        return $this->push;
    }

    public function setPush(bool $push): self
    {
        $this->push = $push;

        return $this;
    }
}