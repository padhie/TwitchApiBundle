<?php

namespace TwitchApiBundle\Model;

class TwitchHost extends TwitchModel
{
    /** @var TwitchChannel */
    private $channel;
    /** @var TwitchChannel */
    private $target;
    /** @var integer */
    private $viewer = 0;

    public function getChannel(): TwitchChannel
    {
        return $this->channel;
    }

    public function setChannel(TwitchChannel $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    public function getTarget(): TwitchChannel
    {
        return $this->target;
    }

    public function setTarget(TwitchChannel $target): self
    {
        $this->target = $target;

        return $this;
    }

    public function getViewer(): int
    {
        return $this->viewer;
    }

    public function setViewer(int $viewer): self
    {
        $this->viewer = $viewer;

        return $this;
    }
}