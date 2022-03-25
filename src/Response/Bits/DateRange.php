<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Bits;

use DateTimeImmutable;
use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class DateRange implements ResponseInterface
{
    private string $statedAt;
    private string $endedAt;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->statedAt = $data['startedAt'];
        $self->endedAt = $data['endedAt'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'startedAt' => $this->statedAt,
            'endedAt' => $this->endedAt,
        ];
    }

    public function getStatedAt(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->statedAt);
    }

    public function getEndedAt(): string
    {
        return $this->endedAt;
    }
}