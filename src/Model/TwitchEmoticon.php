<?php

namespace TwitchApiBundle\Model;

class TwitchEmoticon extends TwitchModel
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $regex;

    /**
     * @var TwitchEmoticonImage[]
     */
    private $images;

    /**
     * @return int
     */
    public function getId(): int
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
     * @return string
     */
    public function getRegex(): string
    {
        return $this->regex;
    }

    /**
     * @param string $regex
     *
     * @return $this
     */
    public function setRegex(string $regex): self
    {
        $this->regex = $regex;

        return $this;
    }

    /**
     * @return TwitchEmoticonImage[]
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param TwitchEmoticonImage[] $images
     *
     * @return $this
     */
    public function setImages(array $images): self
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @param TwitchEmoticonImage $image
     *
     * @return $this
     */
    public function addImage(TwitchEmoticonImage $image): self
    {
        $this->images[] = $image;

        return $this;
    }
}