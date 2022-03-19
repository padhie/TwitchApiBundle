<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\ChannelPoints;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class Image implements ResponseInterface
{
    private string $url1x;
    private string $url2x;
    private string $url4x;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->url1x = $data['url_1x'];
        $self->url2x = $data['url_2x'];
        $self->url4x = $data['url_4x'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'url1x' => $this->url1x,
            'url2x' => $this->url2x,
            'url4x' => $this->url4x,
        ];
    }

    public function getUrl1x(): string
    {
        return $this->url1x;
    }

    public function getUrl2x(): string
    {
        return $this->url2x;
    }

    public function getUrl4x(): string
    {
        return $this->url4x;
    }
}