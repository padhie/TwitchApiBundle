<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Ads;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class StartCommercialResponse implements ResponseInterface
{
    /** @var array<int, Commercial> */
    private array $commercials = [];

    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach($data['data'] as $item) {
            $self->commercials[] = Commercial::createFromArray($item);
        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'commercials' => $this->commercials,
        ];
    }

    /**
     * @return array<int, Commercial>
     */
    public function getCommercials(): array
    {
        return $this->commercials;
    }
}