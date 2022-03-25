<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Videos;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetVideoResponse implements ResponseInterface
{
    /** @var array<int, Video> */
    private array $videos = [];

    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach ($data['data'] as $item) {
            $self->videos[] = Video::createFromArray($item);
        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'videos' => $this->videos,
        ];
    }

    /**
     * @return array<int, Video>
     */
    public function getVideos(): array
    {
        return $this->videos;
    }
}