<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Goals;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetCreatorGoalsResponse implements ResponseInterface
{
    /** @var array<int, Goal> */
    private array $goals = [];

    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach ($data['data'] as $item) {
            $self->goals[] = Goal::createFromArray($item);
        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'goals' => $this->goals,
        ];
    }

    /**
     * @return array<int, Goal>
     */
    public function getGoals(): array
    {
        return $this->goals;
    }
}