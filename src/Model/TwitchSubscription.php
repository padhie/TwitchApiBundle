<?php

namespace Padhie\TwitchApiBundle\Model;

use DateTime;

final class TwitchSubscription implements TwitchModelInterface
{
    /** @var string */
    private $_id;
    /** @var DateTime */
    private $createdAt;
    /** @var string */
    private $subPlan;
    /** @var string */
    private $subPlanName;
    /** @var null|TwitchUser */
    private $user;
    /** @var null|TwitchChannel */
    private $channel;

    private function __construct(string $_id, DateTime $createdAt, string $subPlan, string $subPlanName, ?TwitchUser $user, ?TwitchChannel $channel)
    {
        $this->_id = $_id;
        $this->createdAt = $createdAt;
        $this->subPlan = $subPlan;
        $this->subPlanName = $subPlanName;
        $this->user = $user;
        $this->channel = $channel;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchSubscription
    {
        return new self(
            $json['_id'] ?? '',
            $json['created_at'] ? new DateTime($json['created_at']) : new DateTime(),
            $json['sub_plan'] ?? '',
            $json['sub_plan_name'] ?? '',
            $json['user'] ? TwitchUser::createFromJson($json['user']) : null,
            $json['channel'] ? TwitchChannel::createFromJson($json['channel']) : null
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getId(): string
    {
        return $this->_id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getSubPlan(): string
    {
        return $this->subPlan;
    }

    public function getSubPlanName(): string
    {
        return $this->subPlanName;
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