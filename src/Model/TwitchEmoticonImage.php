<?php

namespace TwitchApiBundle\Model;

class TwitchEmoticonImage extends TwitchModel
{
    /**
     * @var integer
     */
    private $id = null;

    /**
     * @var string
     */
    private $code = null;

    /**
     * @var integer
     */
    private $width = null;

    /**
     * @var integer
     */
    private $height = null;

    /**
     * @var string
     */
    private $url = null;

    /**
     * @var integer
     */
    private $emoticon_set = null;

    /**
     * @return int|null
     */
    public function getWidth(): ?int
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
     * @return int|null
     */
    public function getHeight(): ?int
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
     * @return string|null
     */
    public function getUrl(): ?string
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
     * @return int|null
     */
    public function getEmoticonSet(): ?int
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

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}