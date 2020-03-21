<?php

namespace Padhie\TwitchApiBundle\Model;

final class TwitchEmoticonImage implements TwitchModelInterface
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
    private $emoticonSet;

    private function __construct(
        int $id,
        string $code,
        int $emoticonSet,
        string $url,
        int $width,
        int $height
    ) {
        $this->id = $id;
        $this->code = $code;
        $this->emoticonSet = $emoticonSet;
        $this->url = $url;
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchEmoticonImage
    {
        return new self(
            $json['id'] ?? 0,
            $json['code'] ?? '',
            $json['emoticon_set'] ?? 0,
            $json['url'] ?? '',
            $json['width'] ?? 0,
            $json['height'] ?? 0
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getEmoticonSet(): int
    {
        return $this->emoticonSet;
    }
}