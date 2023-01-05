<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response;

final class ErrorResponse implements ResponseInterface
{
    private string $error;
    private int $status;
    private string $message;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->error = $data['error'];
        $self->status = $data['status'];
        $self->message = $data['message'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'error' => $this->error,
            'status' => $this->status,
            'message' => $this->message,
        ];
    }
}