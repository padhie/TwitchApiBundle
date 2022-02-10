<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Model;

final class TwitchEmote implements TwitchModelInterface
{
    private string $id;
    private string $name;
    private Image $images;
    private string $tier;
    private string $emoteType;
    private string $emoteSetId;
    /** @var array<int, string> */
    private array $format = [];
    /** @var array<int, string> */
    private array $scale = [];
    /** @var array<int, string> */
    private array $themeMode = [];

    private function __construct()
    {}

    public static function createFromJson(array $json): self
    {
        $self = new self();

        $self->id = $json["id"];
        $self->name = $json["name"];
        $self->images = Image::createFromJson($json["images"]);
        $self->tier = $json["tier"];
        $self->emoteType = $json["emote_type"];
        $self->emoteSetId = $json["emote_set_id"];
        $self->format = $json["format"];
        $self->scale = $json["scale"];
        $self->themeMode = $json["theme_mode"];

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

    public function getName(): string
    {
        return $this->name;
    }

    public function getImages(): Image
    {
        return $this->images;
    }

    public function getTier(): string
    {
        return $this->tier;
    }

    public function getEmoteType(): string
    {
        return $this->emoteType;
    }

    public function getEmoteSetId(): string
    {
        return $this->emoteSetId;
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