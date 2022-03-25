<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Channels;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetChannelEditorsResponse implements ResponseInterface
{
    /** @var array<int, Editor> */
    private array $editors = [];

    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach ($data['data'] as $item) {
            $self->editors[] = Editor::createFromArray($item);
        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'editors' => $this->editors,
        ];
    }

    /**
     * @return array<int, Editor>
     */
    public function getEditors(): array
    {
        return $this->editors;
    }
}