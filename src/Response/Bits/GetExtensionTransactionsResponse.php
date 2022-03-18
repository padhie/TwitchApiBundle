<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Bits;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetExtensionTransactionsResponse implements ResponseInterface
{
    /** @var array<int, ExtensionTransaction> */
    private array $extensionTransaction = [];

    /**
     * @var array<string, array<string, mixed>> $data
     */
    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach ($data['data'] as $item) {
            $self->extensionTransaction[] = ExtensionTransaction::createFromArray($item);
        }

        return $self;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'extensionTransaction' => $this->extensionTransaction,
        ];
    }

    /**
     * @return array<int, ExtensionTransaction>
     */
    public function getExtensionTransaction(): array
    {
        return $this->extensionTransaction;
    }
}