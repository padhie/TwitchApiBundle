<?php

declare(strict_types=1);

namespace Model;

class MaxPerUserPerStreamSetting
{
    /** @var bool */
    private $isEnable;
    /** @var int */
    private $maxPerUserPerStream;

    private function __construct(bool $isEnable, int $maxPerUserPerStream)
    {
        $this->isEnable = $isEnable;
        $this->maxPerUserPerStream = $maxPerUserPerStream;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): self
    {
        return new self(
            $json['is_enabled'] ?? false,
            $json['max_per_user_per_stream'] ?? 0
        );
    }

    public function isEnable(): bool
    {
        return $this->isEnable;
    }

    public function getMaxPerUserPerStream(): int
    {
        return $this->maxPerUserPerStream;
    }
}