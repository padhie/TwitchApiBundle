<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response;

final class NoneResponse implements ResponseInterface
{
    public static function createFromArray(array $data): self
    {
        return new self();
    }

    public function jsonSerialize(): array
    {
        return [];
    }
}