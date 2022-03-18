<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Analytics;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetGameAnalyticsResponse implements ResponseInterface
{
    /** @var array<int, Game> */
    private array $games = [];

    /**
     * @var array<string, array<string, mixed>> $data
     */
    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach ($data['data'] as $item) {
            $self->games[] = Game::createFromArray($item);
        }

        return $self;
    }

    /**
     * @return array<string, mixed>
     */
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