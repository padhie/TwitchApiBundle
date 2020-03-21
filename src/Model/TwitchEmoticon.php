<?php

namespace Padhie\TwitchApiBundle\Model;

final class TwitchEmoticon implements TwitchModelInterface
{
    /** @var integer */
    private $id;
    /** @var string */
    private $regex;
    /** @var array<int, TwitchEmoticonImage> */
    private $images;

    /**
     * @param array<int, TwitchEmoticonImage> $images
     */
    private function __construct(int $id, string $regex, array $images)
    {
        $this->id = $id;
        $this->regex = $regex;
        $this->images = $images;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchEmoticon
    {
        /** @var array<int, TwitchEmoticonImage> $images */
        $images = [];
        foreach ($json['images'] ?? [] AS $imageData) {
            $images[] = TwitchEmoticonImage::createFromJson($imageData);
        }

        return new self(
            $json['id'] ?? 0,
            $json['regex'] ?? '',
            $images
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRegex(): string
    {
        return $this->regex;
    }

    /**
     * @return array<int, TwitchEmoticonImage>
     */
    public function getImages(): array
    {
        return $this->images;
    }
}