<?php

namespace Padhie\TwitchApiBundle\Model;

use DateTime;

final class TwitchTeam implements TwitchModelInterface
{
    /** @var int */
    private $_id;
    /** @var null|string */
    private $background;
    /** @var string */
    private $banner;
    /** @var string */
    private $displayName;
    /** @var string */
    private $info;
    /** @var string */
    private $logo;
    /** @var string */
    private $name;
    /** @var DateTime */
    private $createdAt;
    /** @var null|DateTime */
    private $updatedAt;

    private function __construct(
        int $_id,
        ?string $background,
        string $banner,
        string $displayName,
        string $info,
        string $logo,
        string $name,
        DateTime $createdAt,
        ?DateTime $updatedAt
    ) {
        $this->_id = $_id;
        $this->background = $background;
        $this->banner = $banner;
        $this->displayName = $displayName;
        $this->info = $info;
        $this->logo = $logo;
        $this->name = $name;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchTeam
    {
        return new self(
            $json['_id'] ?? 0,
            $json['background'] ?? null,
            $json['banner'] ?? '',
            $json['display_name'] ?? '',
            $json['info'] ?? '',
            $json['logo'] ?? '',
            $json['name'] ?? '',
            new DateTime($json['created_at']),
            $json['updated_at'] ? new DateTime($json['updated_at']) : null
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getId(): int
    {
        return $this->_id;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function getBanner(): ?string
    {
        return $this->banner;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function getInfo(): string
    {
        return $this->info;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }
}