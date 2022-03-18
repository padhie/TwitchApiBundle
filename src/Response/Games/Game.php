<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Games;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class Game implements ResponseInterface
{
    private string $id;
    private string $name;
    private string $boxArtUrl;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->id = $data['id'];
        $self->name = $data['name'];
        $self->boxArtUrl = $data['box_art_url'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'boxArtUrl' => $this->boxArtUrl,
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBoxArtUrl(): string
    {
        return $this->boxArtUrl;
    }
}