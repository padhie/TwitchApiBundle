<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Subscriptions;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class CheckUserSubscriptionResponse implements ResponseInterface
{
    /** @var array<int, UserSubscription> */
    private array $userSubscriptions = [];

    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach ($data['data'] as $item) {
            $self->userSubscriptions[] = UserSubscription::createFromArray($item);
        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'userSubscriptions' => $this->userSubscriptions,
        ];
    }

    /**
     * @return array<int, UserSubscription>
     */
    public function getUserSubscriptions(): array
    {
        return $this->userSubscriptions;
    }
}