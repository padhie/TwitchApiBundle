<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Analytics;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetGameAnalyticsResponse implements ResponseInterface
{
    /** @var array<int, Game> */
    private array $games = [];

    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach ($data['data'] as $item) {
            $self->games[] = Game::createFromArray($item);
        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'games' => $this->games
        ];
    }

    /**
     * @return array<int, Game>
     */
    public function getGames(): array
    {
        return $this->games;
    }
}