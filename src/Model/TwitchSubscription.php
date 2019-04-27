<?php

namespace TwitchApiBundle\Model;

use DateTime;

class TwitchSubscription extends TwitchModel
{
    /** @var string */
    private $_id;
    /** @var DateTime */
    private $created_at;
    /** @var string */
    private $sub_plan;
    /** @var string */
    private $sub_plan_name;
    /** @var TwitchUser */
    private $user;
    /** @var TwitchChannel */
    private $channel;

    public function getId(): string
    {
        return $this->_id;
    }

    public function setId(string $id): self
    {
        $this->_id = $id;

        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getSubPlan(): string
    {
        return $this->sub_plan;
    }

    public function setSubPlan(string $sub_plan): self
    {
        $this->sub_plan = $sub_plan;

        return $this;
    }

    public function getSubPlanName(): string
    {
        return $this->sub_plan_name;
    }

    public function setSubPlanName(string $sub_plan_name): self
    {
        $this->sub_plan_name = $sub_plan_name;

        return $this;
    }

    public function getUser(): ?TwitchUser
    {
        return $this->user;
    }

    public function setUser(TwitchUser $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getChannel(): ?TwitchChannel
    {
        return $this->channel;
    }

    public function setChannel(TwitchChannel $channel): self
    {
        $this->channel = $channel;

        return $this;
    }
}