<?php

namespace Padhie\TwitchApiBundle\Model;

final class TwitchChannelSubscriptions implements TwitchModelInterface
{
    private int $total;
    private int $points;
    /** @var array<int, TwitchSubscription> */
    private array $subscriptions = [];

    private function __construct()
    {}

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchChannelSubscriptions
    {
        $self = new self();

        $self->total = $json['total'] ?? 0;
        $self->points = $json['points'] ?? 0;

        foreach ($json['subscriptions'] ?? [] as $subscription) {
            $self->subscriptions[] = TwitchSubscription::createFromJson($subscription);
        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @return array<int, TwitchSubscription>
     */
    public function getSubscriptions(): array
    {
        return $this->subscriptions;
    }
}