<?php

namespace Padhie\TwitchApiBundle\Model;

class TwitchEmoticon extends TwitchModel
{
    /** @var integer */
    private $id;
    /** @var string */
    private $regex;
    /** @var TwitchEmoticonImage[] */
    private $images;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getRegex(): string
    {
        return $this->regex;
    }

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
     */
    public function setImages(array $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function addImage(TwitchEmoticonImage $image): self
    {
        $this->images[] = $image;

        return $this;
    }
}