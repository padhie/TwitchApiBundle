<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Bits;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class Image implements ResponseInterface
{
    private string $one;
    private string $oneDotFive;
    private string $two;
    private string $three;
    private string $four;

    /**
     * @var array<string, array<string, mixed>> $data
     */
    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->one = $data['1'];
        $self->oneDotFive = $data['1.5'];
        $self->two = $data['2'];
        $self->three = $data['3'];
        $self->four = $data['4'];

        return $self;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'one' => $this->one,
            'oneDotFive' => $this->oneDotFive,
            'two' => $this->two,
            'three' => $this->three,
            'four' => $this->four,
        ];
    }

    public function getOne(): string
    {
        return $this->one;
    }

    public function getOneDotFive(): string
    {
        return $this->oneDotFive;
    }

    public function getTwo(): string
    {
        return $this->two;
    }

    public function getThree(): string
    {
        return $this->three;
    }

    public function getFour(): string
    {
        return $this->four;
    }
}