<?php

namespace Padhie\TwitchApiBundle\Model;

final class TwitchHost implements TwitchModelInterface
{
    /** @var TwitchChannel */
    private $channel;
    /** @var TwitchChannel */
    private $target;
    /** @var int */
    private $viewer;

    private function __construct(TwitchChannel $channel, TwitchChannel $target, int $viewer)
    {
        $this->channel = $channel;
        $this->target = $target;
        $this->viewer = $viewer;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchHost
    {
        return new self(
            $json['channel'],
            $json['target'],
            $json['viewer']
        );
    }

    public function getChannel(): TwitchChannel
    {
        return $this->channel;
    }

    public function getTarget(): TwitchChannel
    {
        return $this->target;
    }

    public function getViewer(): int
    {
        return $this->viewer;
    }
}