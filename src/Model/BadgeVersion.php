<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Model;

final class BadgeVersion implements TwitchModelInterface
{
    private string $id;
    private string $imageUrl1x;
    private string $imageUrl2x;
    private string $imageUrl4x;

    private function __construct()
    {}

    public static function createFromJson(array $json): self
    {
        $self = new self();

        $self->id = $json['id'];
        $self->imageUrl1x = $json['image_url_1x'];
        $self->imageUrl2x = $json['image_url_2x'];
        $self->imageUrl4x = $json['image_url_4x'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getImageUrl1x(): string
    {
        return $this->imageUrl1x;
    }

    public function getImageUrl2x(): string
    {
        return $this->imageUrl2x;
    }

    public function getImageUrl4x(): string
    {
        return $this->imageUrl4x;
    }
}