<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Analytics;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetExtensionAnalyticsResponse implements ResponseInterface
{
    /** @var array<int, Extension> */
    private array $extensions = [];

    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach($data['data'] as $item) {
            $self->extensions[] = Extension::createFromArray($item);
        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'extensions' => $this->extensions,
        ];
    }

    /**
     * @return array<int, Extension>
     */
    public function getExtensions(): array
    {
        return $this->extensions;
    }
}