<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Tests\Response;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final readonly class TestResponse implements ResponseInterface
{
    private function __construct(private array $data)
    {
    }

    public static function createFromArray(array $data): self
    {
        return new self($data);
    }

    public function jsonSerialize(): array
    {
        return [
            'data' => $this->data,
        ];
    }

    public function getData(): array
    {
        return $this->data;
    }
}