<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Analytics;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class Extension implements ResponseInterface
{
    private string $extensionId;
    private string $url;
    private string $type;
    private DateRange $dateRange;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->extensionId = $data['extension_id'];
        $self->url = $data['URL'];
        $self->type = $data['type'];
        $self->dateRange = DateRange::createFromArray($data['date_range']);

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'extensionId' => $this->extensionId,
            'url' => $this->url,
            'type' => $this->type,
            'dateRange' => $this->dateRange,
        ];
    }

    public function getExtensionId(): string
    {
        return $this->extensionId;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDateRange(): DateRange
    {
        return $this->dateRange;
    }
}