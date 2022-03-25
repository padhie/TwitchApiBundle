<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Analytics;

use DateTimeImmutable;
use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class DateRange implements ResponseInterface
{
    private string $startedAt;
    private string $endedAt;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->startedAt = $data['startedAt'];
        $self->endedAt = $data['endedAt'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'startedAt' => $this->startedAt,
            'endedAt' => $this->endedAt,
        ];
    }

    public function getStartedAt(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->startedAt);
    }

    public function getEndedAt(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->endedAt);
    }
}