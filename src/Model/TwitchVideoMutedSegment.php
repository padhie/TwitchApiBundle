<?php

namespace Padhie\TwitchApiBundle\Model;

final class TwitchVideoMutedSegment implements TwitchModelInterface
{
    /** @var int */
    private $duration;
    /** @var int */
    private $offset;

    private function __construct(int $duration, int $offset)
    {
        $this->duration = $duration;
        $this->offset = $offset;
    }

    public static function createFromJson(array $json): TwitchVideoMutedSegment
    {
        return new self(
            $json['duration'] ?? 0,
            $json['offset'] ?? 0
        );
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