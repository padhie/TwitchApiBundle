<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Channels;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetChannelResponse implements ResponseInterface
{
    /** @var array<int, Channel> */
    private array $channels = [];

    public static function createFromArray(array $data): ResponseInterface
    {
        $self = new self();

        foreach($data['data'] as $item) {
            $self->channels[] = Channel::createFromArray($item);
        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'channels' => $this->channels,
        ];
    }

    public function getChannels(): array
    {
        return $this->channels;
    }
}