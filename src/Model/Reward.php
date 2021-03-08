<?php

declare(strict_types=1);

namespace Model;

class Reward
{
    /** @var string  */
    private $id;
    /** @var string  */
    private $title;
    /** @var string  */
    private $prompt;
    /** @var int  */
    private $cost;

    private function __construct(string $id, string $title, string $prompt, int $cost)
    {
        $this->id = $id;
        $this->title = $title;
        $this->prompt = $prompt;
        $this->cost = $cost;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): self
    {
        return new self(
            $json['id'] ?? '',
            $json['title'] ?? '',
            $json['promt'] ?? '',
            $json['cost'] ?? 0
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrompt(): string
    {
        return $this->prompt;
    }

    public function getCost(): int
    {
        return $this->cost;
    }
}