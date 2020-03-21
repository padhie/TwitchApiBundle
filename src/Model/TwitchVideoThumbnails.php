<?php

namespace Padhie\TwitchApiBundle\Model;


final class TwitchVideoThumbnails implements TwitchModelInterface
{
    /** @var array<int, TwitchVideoThumbnail> */
    private $large;
    /** @var array<int, TwitchVideoThumbnail> */
    private $medium;
    /** @var array<int, TwitchVideoThumbnail> */
    private $small;
    /** @var array<int, TwitchVideoThumbnail> */
    private $template;

    /**
     * @param array<int, TwitchVideoThumbnail> $large
     * @param array<int, TwitchVideoThumbnail> $medium
     * @param array<int, TwitchVideoThumbnail> $small
     * @param array<int, TwitchVideoThumbnail> $template
     */
    private function __construct(array $large, array $medium, array $small, array $template)
    {
        $this->large = $large;
        $this->medium = $medium;
        $this->small = $small;
        $this->template = $template;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchVideoThumbnails
    {
        $larges = [];
        foreach ($json['large'] ?? [] as $large) {
            $larges[] = TwitchVideoThumbnail::createFromJson($large);
        }

        $mediums = [];
        foreach ($json['medium'] ?? [] as $medium) {
            $mediums[] = TwitchVideoThumbnail::createFromJson($medium);
        }

        $smalls = [];
        foreach ($json['small'] ?? [] as $small) {
            $smalls[] = TwitchVideoThumbnail::createFromJson($small);
        }

        $templates = [];
        foreach ($json['template'] ?? [] as $template) {
            $templates[] = TwitchVideoThumbnail::createFromJson($template);
        }

        return new self($larges, $mediums, $smalls, $templates);
    }

    /**
     * @return array<int, TwitchVideoThumbnail>
     */
    public function getLarge(): array
    {
        return $this->large;
    }

    /**
     * @return array<int, TwitchVideoThumbnail>
     */
    public function getMedium(): array
    {
        return $this->medium;
    }

    /**
     * @return array<int, TwitchVideoThumbnail>
     */
    public function getSmall(): array
    {
        return $this->small;
    }

    /**
     * @return array<int, TwitchVideoThumbnail>
     */
    public function getTemplate(): array
    {
        return $this->template;
    }
}