<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Bits;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class Images implements ResponseInterface
{
    private ImageColor $dark;
    private ImageColor $light;

    /**
     * @var array<string, array<string, mixed>> $data
     */
    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->dark = ImageColor::createFromArray($data['dark']);
        $self->light = ImageColor::createFromArray($data['light']);

        return $self;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'dark' => $this->dark,
            'light' => $this->light,
        ];
    }

    public function getDark(): ImageColor
    {
        return $this->dark;
    }

    public function getLight(): ImageColor
    {
        return $this->light;
    }
}