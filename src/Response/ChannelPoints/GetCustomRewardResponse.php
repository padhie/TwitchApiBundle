<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\ChannelPoints;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetCustomRewardResponse implements ResponseInterface
{
    /** @var array<int, CustomReward> */
    private array $customRewards = [];

    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach ($data['data'] as $item) {
            $self->customRewards[] = CustomReward::createFromArray($item);
        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'customRewards' => $this->customRewards
        ];
    }

    /**
     * @return array<int, CustomReward>
     */
    public function getCustomRewards(): array
    {
        return $this->customRewards;
    }
}