<?php

declare(strict_types=1);

namespace Model;

use Padhie\TwitchApiBundle\Model\TwitchModelInterface;

class Images implements TwitchModelInterface
{
    /** @var string */
    private $url1x;
    /** @var string */
    private $url2x;
    /** @var string */
    private $url4x;

    private function __construct(string $url1x, string $url2x, string $url4x)
    {
        $this->url1x = $url1x;
        $this->url2x = $url2x;
        $this->url4x = $url4x;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): self
    {
        return new self(
            $json['url_1x'] ?? '',
            $json['url_2x'] ?? '',
            $json['url_4x'] ?? ''
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getUrl1x(): string
    {
        return $this->url1x;
    }

    public function getUrl2x(): string
    {
        return $this->url2x;
    }

    public function getUrl4x(): string
    {
        return $this->url4x;
    }
}