<?php

namespace Padhie\TwitchApiBundle\Model;


class TwitchVideoThumbnail
{
    /** @var string */
    private $type;
    /** @var string */
    private $url;

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}