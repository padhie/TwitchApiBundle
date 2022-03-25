<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Chat;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetEmoteSetsResponse implements ResponseInterface
{
    /** @var array<int, EmoteSet> */
    private array $emoteSets = [];
    private string $template;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->template = $data['template'];
        foreach ($data['data'] as $item) {
            $self->emoteSets[] = EmoteSet::createFromArray($item);
        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'emoteSets' => $this->emoteSets,
            'template' => $this->template,
        ];
    }

    /**
     * @return array<int, EmoteSet>
     */
    public function getEmoteSets(): array
    {
        return $this->emoteSets;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }
}