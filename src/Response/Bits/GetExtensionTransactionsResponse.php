<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Bits;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetExtensionTransactionsResponse implements ResponseInterface
{
    /** @var array<int, ExtensionTransaction> */
    private array $extensionTransaction = [];

    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach ($data['data'] as $item) {
            $self->extensionTransaction[] = ExtensionTransaction::createFromArray($item);
        }

        return $self;
    }

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