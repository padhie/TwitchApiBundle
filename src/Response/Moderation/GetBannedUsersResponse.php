<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Moderation;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class GetBannedUsersResponse implements ResponseInterface
{
    /** @var array<int, BannedUser> */
    private array $bannedUser = [];

    public static function createFromArray(array $data): self
    {
        $self = new self();

        foreach ($data['data'] as $item) {
            $self->bannedUser[] = BannedUser::createFromArray($item);
        }

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'bannedUser' => $this->bannedUser,
        ];
    }

    /**
     * @return array<int, BannedUser>
     */
    public function getBannedUser(): array
    {
        return $this->bannedUser;
    }
}