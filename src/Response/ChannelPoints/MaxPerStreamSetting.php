<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\ChannelPoints;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class MaxPerStreamSetting implements ResponseInterface
{
    private bool $isEnabled;
    private int $maxPerStream;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->isEnabled = $data['is_enabled'];
        $self->maxPerStream = $data['max_per_stream'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'isEnabled' => $this->isEnabled,
            'maxPerStream' => $this->maxPerStream,
        ];
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function getMaxPerStream(): int
    {
        return $this->maxPerStream;
    }
}