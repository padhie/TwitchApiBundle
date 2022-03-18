<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Bits;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class ProductData implements ResponseInterface
{
    private string $domain;
    private string $sku;
    private Cost $cost;
    private bool $isDevelopment;
    private string $displayName;
    private string $expiration;
    private string $broadcast;


    /**
     * @var array<string, array<string, mixed>> $data
     */
    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->domain = $data['domain'];
        $self->sku = $data['sku'];
        $self->cost = Cost::createFromArray($data['cost']);
        $self->isDevelopment = (bool) $data['isDevelopment'];
        $self->displayName = $data['displayName'];
        $self->expiration = $data['expiration'];
        $self->broadcast = $data['broadcast'];

        return $self;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'domain' => $this->domain,
            'sku' => $this->sku,
            'cost' => $this->cost,
            'isDevelopment' => $this->isDevelopment,
            'displayName' => $this->displayName,
            'expiration' => $this->expiration,
            'broadcast' => $this->broadcast,
        ];
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getCost(): Cost
    {
        return $this->cost;
    }

    public function isDevelopment(): bool
    {
        return $this->isDevelopment;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function getExpiration(): string
    {
        return $this->expiration;
    }

    public function getBroadcast(): string
    {
        return $this->broadcast;
    }
}