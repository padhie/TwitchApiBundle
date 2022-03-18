<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Bits;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class LeaderboardItem implements ResponseInterface
{
    private int $rank;
    private int $score;
    private string $userId;
    private string $userLogin;
    private string $userName;

    /**
     * @var array<string, mixed> $data
     */
    public static function createFromArray(array $data): ResponseInterface
    {
        $self = new self();

        $self->rank = $data['rank'];
        $self->score = $data['score'];
        $self->userId = $data['userId'];
        $self->userLogin = $data['userLogin'];
        $self->userName = $data['userName'];

        return $self;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'rank' => $this->rank,
            'score' => $this->score,
            'userId' => $this->userId,
            'userLogin' => $this->userLogin,
            'userName' => $this->userName,
        ];
    }

    public function getRank(): int
    {
        return $this->rank;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getUserLogin(): string
    {
        return $this->userLogin;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }
}