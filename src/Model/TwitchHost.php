<?php

namespace TwitchApiBundle\Model;

class TwitchHost extends TwitchModel
{
    /**
     * @var TwitchChannel
     */
    private $channel;

    /**
     * @var TwitchChannel
     */
    private $target;

    /**
     * @var integer
     */
    private $viewer = 0;

    /**
     * @return TwitchChannel
     */
    public function getChannel(): TwitchChannel
    {
        return $this->channel;
    }

    /**
     * @param TwitchChannel $channel
     *
     * @return $this
     */
    public function setChannel(TwitchChannel $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * @return TwitchChannel
     */
    public function getTarget(): TwitchChannel
    {
        return $this->target;
    }

    /**
     * @param TwitchChannel $target
     *
     * @return $this
     */
    public function setTarget(TwitchChannel $target): self
    {
        $this->target = $target;

        return $this;
    }

    /**
     * @return int
     */
    public function getViewer(): int
    {
        return $this->viewer;
    }

    /**
     * @param int $viewer
     *
     * @return $this
     */
    public function setViewer(int $viewer): self
    {
        $this->viewer = $viewer;

        return $this;
    }
}