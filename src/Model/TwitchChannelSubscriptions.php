<?php

namespace Padhie\TwitchApiBundle\Model;

final class TwitchChannelSubscriptions implements TwitchModelInterface
{
    /** @var int */
    private $_total;
    /** @var array<int, TwitchSubscription> */
    private $subscriptions;

    /**
     * @param array<int, TwitchSubscription> $subscriptions
     */
    private function __construct(int $_total, array $subscriptions)
    {
        $this->_total = $_total;
        $this->subscriptions = $subscriptions;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchChannelSubscriptions
    {
        $subscriptions = [];
        foreach ($json['subscriptions'] ?? [] as $subscription) {
            $subscriptions[] = TwitchSubscription::createFromJson($subscription);
        }

        return new self(
            $json['_total'] ?? 0,
            $subscriptions
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getTotal(): int
    {
        return $this->_total;
    }

    /**
     * @return array<int, TwitchSubscription> $subscriptions
     */
    public function getSubscriptions(): array
    {
        return $this->subscriptions;
    }
}