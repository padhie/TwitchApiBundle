<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Bits;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class ImageColor implements ResponseInterface
{
    private Image $animated;
    private Image $static;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->animated = Image::createFromArray($data['animated']);
        $self->static = Image::createFromArray($data['static']);

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'animated' => $this->animated,
            'static' => $this->static,
        ];
    }

    public function getAnimated(): Image
    {
        return $this->animated;
    }

    public function getStatic(): Image
    {
        return $this->static;
    }
}