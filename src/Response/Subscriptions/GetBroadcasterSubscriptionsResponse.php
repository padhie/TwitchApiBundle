<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Subscriptions;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetBroadcasterSubscriptionsResponse implements ResponseInterface
{
    /** @var array<int, Subscription> */
    private array $subscriptions = [];
    private int $total;
    private int $points;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->total = $data['total'];
        $self->points = $data['points'];
        foreach ($data['data'] as $item) {
            $self->subscriptions[] = Subscription::createFromArray($item);
        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'total' => $this->total,
            'points' => $this->points,
            'subscriptions' => $this->subscriptions,
        ];
    }

    /**
     * @return array<int, Subscription>
     */
    public function getSubscriptions(): array
    {
        return $this->subscriptions;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getPoints(): int
    {
        return $this->points;
    }
}