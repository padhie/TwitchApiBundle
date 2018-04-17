<?php

namespace TwitchApiBundle\Model;


class TwitchEmoticonImage
{
    /**
     * @var integer
     */
    private $width;

    /**
     * @var integer
     */
    private $height;

    /**
     * @var string
     */
    private $url;

    /**
     * @var integer
     */
    private $emoticon_set;

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     *
     * @return $this
     */
    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     *
     * @return $this
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return int
     */
    public function getEmoticonSet(): int
    {
        return $this->emoticon_set;
    }

    /**
     * @param int $emoticon_set
     *
     * @return $this
     */
    public function setEmoticonSet(int $emoticon_set): self
    {
        $this->emoticon_set = $emoticon_set;

        return $this;
    }
}