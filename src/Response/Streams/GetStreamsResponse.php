<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Streams;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetStreamsResponse implements ResponseInterface
{
    /** @var array<int, Stream> */
    private array $streams = [];

    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach ($data['data'] as $item) {
            $self->streams[] = Stream::createFromArray($item);

        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'streams' => $this->streams,

        ];
    }

    /**
     * @return array<int, Stream>
     */
    public function getStreams(): array
    {
        return $this->streams;
    }
}