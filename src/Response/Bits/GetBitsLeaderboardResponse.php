<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Bits;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetBitsLeaderboardResponse implements ResponseInterface
{
    /** @var array<int LeaderboardItem> */
    private array $items = [];
    private DateRange $dateRange;
    private int $total;

    /**
     * @var array<string, array<string, mixed>> $data
     */
    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach ($data['data'] as $item) {
            $self->items[] = LeaderboardItem::createFromArray($item);
            $self->dateRange = DateRange::createFromArray($item);
            $self->total = $item['total'];
        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'items' => $this->items,
            'dateRange' => $this->dateRange,
            'total' => $this->total,
        ];
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getDateRange(): DateRange
    {
        return $this->dateRange;
    }

    public function getTotal(): int
    {
        return $this->total;
    }
}