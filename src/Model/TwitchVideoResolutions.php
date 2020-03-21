<?php

namespace Padhie\TwitchApiBundle\Model;

final class TwitchVideoResolutions implements TwitchModelInterface
{
    /** @var string */
    private $chunked;
    /** @var string */
    private $high;
    /** @var string */
    private $low;
    /** @var string */
    private $medium;
    /** @var string */
    private $mobile;

    private function __construct(string $chunked, string $high, string $low, string $medium, string $mobile)
    {
        $this->chunked = $chunked;
        $this->high = $high;
        $this->low = $low;
        $this->medium = $medium;
        $this->mobile = $mobile;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchVideoResolutions
    {
        return new self(
            $json['chunked'] ?? '',
            $json['high'] ?? '',
            $json['low'] ?? '',
            $json['medium'] ?? '',
            $json['mobile'] ?? ''
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getChunked(): string
    {
        return $this->chunked;
    }

    public function getHigh(): string
    {
        return $this->high;
    }

    public function getLow(): string
    {
        return $this->low;
    }

    public function getMedium(): string
    {
        return $this->medium;
    }

    public function getMobile(): string
    {
        return $this->mobile;
    }
}