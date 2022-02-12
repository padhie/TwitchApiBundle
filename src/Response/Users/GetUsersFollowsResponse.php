<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Users;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetUsersFollowsResponse implements ResponseInterface
{
    private int $total;
    /** @var array<int, User> */
    private array $users = [];

    /**
     * @inheritDoc
     */
    public static function createFromArray(array $data): ResponseInterface
    {
        $self = new self();

        $self->total = $data['total'];

        foreach ($data['data'] as $item) {
            $self->users[] = User::createFromArray($item);
        }

        return $self;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            'total' => $this->total,
            'users' => $this->users,
        ];
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @return array<int, User>
     */
    public function getUsers(): array
    {
        return $this->users;
    }
}