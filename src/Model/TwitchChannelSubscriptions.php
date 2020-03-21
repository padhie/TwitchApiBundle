<?php

namespace Padhie\TwitchApiBundle\Model;

class TwitchChannelSubscriptions
{
    /** @var int */
    private $_total;
    /** @var array<TwitchSubscription> */
    private $subscriptions;

    public function getTotal(): int
    {
        return $this->_total;
    }

    public function setTotal(int $total): void
    {
        $this->_total = $total;
    }

    public function getSubscriptions(): array
    {
        return $this->subscriptions;
    }

    public function setSubscriptions(array $subscriptions): void
    {
        $this->subscriptions = $subscriptions;
    }
}