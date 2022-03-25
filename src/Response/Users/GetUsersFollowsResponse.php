<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Users;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetUsersFollowsResponse implements ResponseInterface
{
    private int $total;
    /** @var array<int, FollowerUser> */
    private array $followerUsers = [];

    /**
     * @inheritDoc
     */
    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->total = $data['total'];

        foreach ($data['data'] as $item) {
            $self->followerUsers[] = FollowerUser::createFromArray($item);
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
            'followerUsers' => $this->followerUsers,
        ];
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @return array<int, FollowerUser>
     */
    public function getFollowerUsers(): array
    {
        return $this->followerUsers;
    }
}