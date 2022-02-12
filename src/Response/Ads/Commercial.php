<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Ads;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class Commercial implements ResponseInterface
{
    private int $length;
    private string $message;
    private int $retryAfter;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->length = $data['length'];
        $self->message= $data['message'];
        $self->retryAfter= $data['retry_after'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'length' => $this->length,
            'message' => $this->message,
            'retryAfter' => $this->retryAfter,
        ];
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getRetryAfter(): int
    {
        return $this->retryAfter;
    }
}