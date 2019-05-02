<?php

namespace Padhie\TwitchApiBundle\Model;

class TwitchEmoticonImage extends TwitchModel
{
    /** @var integer */
    private $id;
    /** @var string */
    private $code;
    /** @var integer */
    private $width;
    /** @var integer */
    private $height;
    /** @var string */
    private $url;
    /** @var integer */
    private $emoticon_set;

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getEmoticonSet(): ?int
    {
        return $this->emoticon_set;
    }

    public function setEmoticonSet(int $emoticon_set): self
    {
        $this->emoticon_set = $emoticon_set;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}