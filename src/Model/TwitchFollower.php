<?php

namespace Padhie\TwitchApiBundle\Model;

use DateTime;

final class TwitchFollower implements TwitchModelInterface
{
    /** @var DateTime */
    private $createdAt;
    /** @var boolean */
    private $notifications;
    /** @var null|TwitchUser */
    private $user;
    /** @var null|TwitchChannel */
    private $channel;

    private function __construct(
        DateTime $createdAt,
        bool $notifications,
        ?TwitchUser $user,
        ?TwitchChannel $channel
    ) {
        $this->createdAt = $createdAt;
        $this->notifications = $notifications;
        $this->user = $user;
        $this->channel = $channel;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchFollower
    {
        return new self(
            $json['created_at'] ? new DateTime($json['created_at']): new DateTime(),
            $json['notifications'] ?? false,
            $json['user'] ? TwitchUser::createFromJson($json['user']) : null,
            $json['channel'] ? TwitchChannel::createFromJson($json['channel']) : null
        );
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function isNotifications(): bool
    {
        return $this->notifications;
    }

    public function getUser(): ?TwitchUser
    {
        return $this->user;
    }

    public function getChannel(): ?TwitchChannel
    {
        return $this->channel;
    }
    
}