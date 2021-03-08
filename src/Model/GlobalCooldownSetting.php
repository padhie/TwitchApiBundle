<?php

declare(strict_types=1);

namespace Model;

class GlobalCooldownSetting
{
    /** @var bool */
    private $isEnable;
    /** @var int */
    private $globalCooldownSeconds;

    private function __construct(bool $isEnable, int $globalCooldownSeconds)
    {
        $this->isEnable = $isEnable;
        $this->globalCooldownSeconds = $globalCooldownSeconds;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): self
    {
        return new self(
            $json['is_enabled'] ?? false,
            $json['global_cooldown_seconds'] ?? 0
        );
    }

    public function isEnable(): bool
    {
        return $this->isEnable;
    }

    public function getGlobalCooldownSeconds(): int
    {
        return $this->globalCooldownSeconds;
    }
}