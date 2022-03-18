<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Bits;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetCheermotesResponse implements ResponseInterface
{
    private string $prefix;
    /** @var array<int, Tier> */
    private array $tiers = [];
    private string $type;
    private int $order;
    private string $lastUpdated;

    /**
     * @var array<string, array<string, mixed>> $data
     */
    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach ($data['data'] as $item) {
            $self->prefix = $item['prefix'];
            $self->tiers[] = Tier::createFromArray($item);
            $self->type = $item['type'];
            $self->order = (int) $item['order'];
            $self->lastUpdated = $item['last_updated'];
        }

        return $self;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'prefix' => $this->prefix,
            'tiers' => $this->tiers,
            'type' => $this->type,
            'order' => $this->order,
            'lastUpdated' => $this->lastUpdated,
        ];
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * @return array<int, Tier>
     */
    public function getTiers(): array
    {
        return $this->tiers;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function getLastUpdated(): string
    {
        return $this->lastUpdated;
    }
}