<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Analytics;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetExtensionAnalyticsResponse implements ResponseInterface
{
    /** @var array<int, Extension> */
    private array $extensions = [];

    /**
     * @var array<string, array<string, mixed>> $data
     */
    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach($data['data'] as $item) {
            $self->extensions[] = Extension::createFromArray($item);
        }

        return $self;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'extensions' => $this->extensions,
        ];
    }

    public function getExtensions(): array
    {
        return $this->extensions;
    }
}