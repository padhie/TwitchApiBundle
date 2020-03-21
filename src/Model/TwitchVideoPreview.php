<?php

namespace Padhie\TwitchApiBundle\Model;

final class TwitchVideoPreview implements TwitchModelInterface
{
    /** @var string */
    private $large;
    /** @var string */
    private $medium;
    /** @var string */
    private $small;
    /** @var string */
    private $template;

    private function __construct(string $large, string $medium, string $small, string $template)
    {
        $this->large = $large;
        $this->medium = $medium;
        $this->small = $small;
        $this->template = $template;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchVideoPreview
    {
        return new self(
            $json['large'] ?? '',
            $json['medium'] ?? '',
            $json['small'] ?? '',
            $json['template'] ?? ''
        );
    }

    public function getLarge(): string
    {
        return $this->large;
    }

    public function getMedium(): string
    {
        return $this->medium;
    }

    public function getSmall(): string
    {
        return $this->small;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }
}