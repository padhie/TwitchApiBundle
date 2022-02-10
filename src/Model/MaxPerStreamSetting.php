<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Model;

use Padhie\TwitchApiBundle\Model\TwitchModelInterface;

class MaxPerStreamSetting implements TwitchModelInterface
{
    /** @var bool */
    private $isEnable;
    /** @var int */
    private $maxPerStream;

    private function __construct(bool $isEnable, int $maxPerStream)
    {
        $this->isEnable = $isEnable;
        $this->maxPerStream = $maxPerStream;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): self
    {
        return new self(
            $json['is_enabled'] ?? false,
            $json['max_per_stream'] ?? 0
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function isEnable(): bool
    {
        return $this->isEnable;
    }

    public function getMaxPerStream(): int
    {
        return $this->maxPerStream;
    }
}