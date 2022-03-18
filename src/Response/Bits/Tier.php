<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Bits;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class Tier implements ResponseInterface
{
    private int $minBits;
    private string $id;
    private string $color;
    private Images $images;
    private bool $canCheer;
    private bool $showInBitsCard;

    /**
     * @var array<string, array<string, mixed>> $data
     */
    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->minBits = $data['min_bits'];
        $self->id = $data['id'];
        $self->color = $data['color'];
        $self->images = Images::createFromArray($data['images']);
        $self->canCheer = $data['can_cheer'];
        $self->showInBitsCard = $data['show_in_bits_card'];

        return $self;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'minBits' => $this->minBits,
            'id' => $this->id,
            'color' => $this->color,
            'image' => $this->images,
            'canCheer' => $this->canCheer,
            'showInBitsCard' => $this->showInBitsCard,
        ];
    }

    public function getMinBits(): int
    {
        return $this->minBits;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getImages(): Images
    {
        return $this->images;
    }

    public function isCanCheer(): bool
    {
        return $this->canCheer;
    }

    public function isShowInBitsCard(): bool
    {
        return $this->showInBitsCard;
    }
}