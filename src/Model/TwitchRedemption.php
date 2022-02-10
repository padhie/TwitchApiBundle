<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Model;

use DateTime;

class TwitchRedemption
{
    public const STATUS_UNFULFILLED = 'UNFULFILLED';
    public const STATUS_FULFILLED = 'FULFILLED';
    public const STATUS_CANCELED = 'CANCELED';

    /** @var string  */
    private $id;
    /** @var string  */
    private $broadcasterName;
    /** @var string  */
    private $broadcasterLogin;
    /** @var string  */
    private $broadcasterId;
    /** @var string  */
    private $userLogin;
    /** @var string  */
    private $userId;
    /** @var string  */
    private $userName;
    /** @var string  */
    private $userInput;
    /** @var string  */
    private $status;
    /** @var DateTime|null  */
    private $redeemedAt;
    /** @var Reward|null  */
    private $reward;

    private function __construct(
        string $id,
        string $broadcasterName,
        string $broadcasterLogin,
        string $broadcasterId,
        string $userLogin,
        string $userId,
        string $userName,
        string $userInput,
        string $status,
        ?DateTime $redeemedAt,
        ?Reward $reward
    ) {

        $this->id = $id;
        $this->broadcasterName = $broadcasterName;
        $this->broadcasterLogin = $broadcasterLogin;
        $this->broadcasterId = $broadcasterId;
        $this->userLogin = $userLogin;
        $this->userId = $userId;
        $this->userName = $userName;
        $this->userInput = $userInput;
        $this->status = $status;
        $this->redeemedAt = $redeemedAt;
        $this->reward = $reward;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchRedemption
    {
        return new self(
            $json['id'] ?? '',
            $json['broadcaster_name'] ?? '',
            $json['broadcaster_login'] ?? '',
            $json['broadcaster_id'] ?? '',
            $json['user_login'] ?? '',
            $json['user_id'] ?? '',
            $json['user_name'] ?? '',
            $json['user_input'] ?? '',
            $json['status'] ?? self::STATUS_CANCELED,
            $json['redeemed_at'] ? new DateTime($json['redeemed_at']) : null,
            $json['reward'] ? Reward::createFromJson($json['reward']): null
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getBroadcasterName(): string
    {
        return $this->broadcasterName;
    }

    public function getBroadcasterLogin(): string
    {
        return $this->broadcasterLogin;
    }

    public function getBroadcasterId(): string
    {
        return $this->broadcasterId;
    }

    public function getUserLogin(): string
    {
        return $this->userLogin;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getUserInput(): string
    {
        return $this->userInput;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getRedeemedAt(): ?DateTime
    {
        return $this->redeemedAt;
    }

    public function getReward(): ?Reward
    {
        return $this->reward;
    }
}