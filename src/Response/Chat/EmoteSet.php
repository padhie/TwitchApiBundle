<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Chat;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class EmoteSet implements ResponseInterface
{
    private string $id;
    private string $name;
    private Images $images;
    private string $emoteType;
    private string $emoteSetId;
    private string $ownerId;
    /** @var array<int, string> */
    private array $format = [];
    /** @var array<int, string> */
    private array $scale = [];
    /** @var array<int, string> */
    private array $themeMode = [];

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->id = $data['id'];
        $self->name = $data['name'];
        $self->images = Images::createFromArray($data['images']);
        $self->emoteType = $data['emote_type'];
        $self->emoteSetId = $data['emote_set_id'];
        $self->ownerId = $data['owner_id'];
        $self->format = $data['format'];
        $self->scale = $data['scale'];
        $self->themeMode = $data['theme_mode'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'images' => $this->images,
            'emoteType' => $this->emoteType,
            'emoteSetId' => $this->emoteSetId,
            'ownerId' => $this->ownerId,
            'format' => $this->format,
            'scale' => $this->scale,
            'themeMode' => $this->themeMode,
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

    public function getImages(): Images
    {
        return $this->images;
    }

    public function getEmoteType(): string
    {
        return $this->emoteType;
    }

    public function getEmoteSetId(): string
    {
        return $this->emoteSetId;
    }

    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    /**
     * @return array<int, string>
     */
    public function getFormat(): array
    {
        return $this->format;
    }

    /**
     * @return array<int, string>
     */
    public function getScale(): array
    {
        return $this->scale;
    }

    /**
     * @return array<int, string>
     */
    public function getThemeMode(): array
    {
        return $this->themeMode;
    }
}