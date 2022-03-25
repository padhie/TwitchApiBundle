<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\ChannelPoints;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class MaxPerUserPerStreamSetting implements ResponseInterface
{
    private bool $isEnabled;
    private int $maxPerUserPerStream;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->isEnabled = $data['is_enabled'];
        $self->maxPerUserPerStream = $data['max_per_user_per_stream'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'isEnabled' => $this->isEnabled,
            'maxPerUserPerStream' => $this->maxPerUserPerStream,
        ];
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function getMaxPerUserPerStream(): int
    {
        return $this->maxPerUserPerStream;
    }
}