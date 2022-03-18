<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Analytics;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class Game implements ResponseInterface
{
    private string $gameId;
    private string $url;
    private string $type;
    private DateRange $dateRange;

    /**
     * @var array<string, array<string, mixed>> $data
     */
    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->gameId = $data['game_id'];
        $self->url = $data['URL'];
        $self->type = $data['type'];
        $self->dateRange = DateRange::createFromArray($data['date_range']);

        return $self;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'gameId' => $this->gameId,
            'url' => $this->url,
            'type' => $this->type,
            'dateRange' => $this->dateRange,
        ];
    }

    public function getGameId(): string
    {
        return $this->gameId;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDateRange(): DateRange
    {
        return $this->dateRange;
    }
}