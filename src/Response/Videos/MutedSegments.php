<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Videos;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class MutedSegments implements ResponseInterface
{
    private int $duration;
    private int $offset;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->duration = $data['duration'];
        $self->offset = $data['offset'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'duration' => $this->duration,
            'offset' => $this->offset,
        ];
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}