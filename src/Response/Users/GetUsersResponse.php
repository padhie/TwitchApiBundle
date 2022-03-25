<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Users;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetUsersResponse implements ResponseInterface
{
    /** @var array<int, User> */
    private array $users = [];

    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach ($data['data'] as $item) {
            $self->users[] = User::createFromArray($item);
        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'users' => $this->users,
        ];
    }

    /**
     * @return array<int, User>
     */
    public function getUsers(): array
    {
        return $this->users;
    }
}