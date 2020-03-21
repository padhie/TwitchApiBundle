<?php

namespace Padhie\TwitchApiBundle\Model;


final class TwitchVideoThumbnail implements TwitchModelInterface
{
    /** @var string */
    private $type;
    /** @var string */
    private $url;

    private function __construct(string $type, string $url)
    {
        $this->type = $type;
        $this->url = $url;
    }

    public static function createFromJson(array $json): TwitchVideoThumbnail
    {
        return new self(
            $json['type'] ?? '',
            $json['url'] ?? ''
        );
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}