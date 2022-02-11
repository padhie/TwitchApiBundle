<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response;

use JsonSerializable;

interface ResponseInterface extends JsonSerializable
{
    /**
     * @param array<mixed> $data
     */
    public static function createFromArray(array $data): self;

    /**
     * @return array<mixed>
     */
    public function jsonSerialize(): array;
}