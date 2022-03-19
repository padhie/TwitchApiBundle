<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\ChannelPoints;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GlobalCooldownSetting implements ResponseInterface
{
    private bool $isEnabled;
    private int $globalCooldownSeconds;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->isEnabled = $data['is_enabled'];
        $self->globalCooldownSeconds = $data['global_cooldown_seconds'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'isEnabled' => $this->isEnabled,
            'globalCooldownSeconds' => $this->globalCooldownSeconds,
        ];
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function getGlobalCooldownSeconds(): int
    {
        return $this->globalCooldownSeconds;
    }
}