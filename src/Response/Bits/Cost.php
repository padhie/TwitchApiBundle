<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Bits;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class Cost implements ResponseInterface
{
    private int $amount;
    private string $type;

    /**
     * @var array<string, array<string, mixed>> $data
     */
    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->amount = $data['amount'];
        $self->type = $data['type'];

        return $self;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'amount' => $this->amount,
            'type' => $this->type,
        ];
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getType(): string
    {
        return $this->type;
    }
}