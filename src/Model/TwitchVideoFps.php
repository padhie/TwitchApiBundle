<?php

namespace Padhie\TwitchApiBundle\Model;

final class TwitchVideoFps implements TwitchModelInterface
{
    /** @var float */
    private $chunked;
    /** @var float */
    private $high;
    /** @var float */
    private $low;
    /** @var float */
    private $medium;
    /** @var float */
    private $mobile;

    private function __construct(float $chunked, float $high, float $low, float $medium, float $mobile)
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
    public static function createFromJson(array $json): TwitchVideoFps
    {
        return new self(
            $json['chunked'] ?? 0.0,
            $json['high'] ?? 0.0,
            $json['low'] ?? 0.0,
            $json['medium'] ?? 0.0,
            $json['mobile'] ?? 0.0
        );
    }

    public function getChunked(): float
    {
        return $this->chunked;
    }

    public function getHigh(): float
    {
        return $this->high;
    }

    public function getLow(): float
    {
        return $this->low;
    }

    public function getMedium(): float
    {
        return $this->medium;
    }

    public function getMobile(): float
    {
        return $this->mobile;
    }
}