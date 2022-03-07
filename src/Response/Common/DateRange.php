<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Common;

use DateTimeImmutable;
use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class DateRange implements ResponseInterface
{
    private DateTimeImmutable $startedAt;
    private DateTimeImmutable $endedAt;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->startedAt = new DateTimeImmutable($data['started_at']);
        $self->endedAt = new DateTimeImmutable($data['ended_at']);

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
        return $this->startedAt;
    }

    public function getEndedAt(): DateTimeImmutable
    {
        return $this->endedAt;
    }
}