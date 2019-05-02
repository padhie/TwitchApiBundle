<?php

namespace Padhie\TwitchApiBundle\Model;


class TwitchVideoMutedSegments
{
    /** @var int */
    private $duration;
    /** @var int */
    private $offset;

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setOffset(int $offset): self
    {
        $this->offset = $offset;

        return $this;
    }
}