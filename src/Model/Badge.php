<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Model;

final class Badge implements TwitchModelInterface
{
    private string $setId;
    /** @var array<int, BadgeVersion> */
    private array $versions = [];

    private function __construct()
    {}

    public static function createFromJson(array $json): self
    {
        $self = new self();

        $self->setId = $json['set_id'];
        foreach ($json['versions'] ?? [] as $version) {
            $self->versions[] = BadgeVersion::createFromJson($version);
        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getSetId(): string
    {
        return $this->setId;
    }

    /**
     * @return array<int, BadgeVersion>
     */
    public function getVersions(): array
    {
        return $this->versions;
    }
}