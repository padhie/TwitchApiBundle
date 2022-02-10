<?php

namespace Padhie\TwitchApiBundle\Model;

final class TwitchVideoMutedSegment implements TwitchModelInterface
{
    private int $duration;
    private int $offset;

    private function __construct()
    {}

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchVideoMutedSegment
    {
        $self = new self();

        $self->duration = $json['duration'];
        $self->offset = $json['offset'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
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