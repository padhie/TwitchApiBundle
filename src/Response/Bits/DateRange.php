<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Bits;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class DateRange implements ResponseInterface
{
    private string $statedAt;
    private string $endedAt;

    /**
     * @var array<string, array<string, mixed>> $data
     */
    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->statedAt = $data['startedAt'];
        $self->endedAt = $data['endedAt'];

        return $self;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'startedAt' => $this->statedAt,
            'endedAt' => $this->endedAt,
        ];
    }

    public function getStatedAt(): string
    {
        return $this->statedAt;
    }

    public function getEndedAt(): string
    {
        return $this->endedAt;
    }
}