<?php

namespace TwitchApiBundle\Model;

class TwitchSubscription extends TwitchModel
{
    /**
     * @var integer
     */
    private $_id;
    /**
     * @var \DateTime
     */
    private $created_at;
    /**
     * @var string
     */
    private $sub_plan;
    /**
     * @var string
     */
    private $sub_plan_name;

    /**
     * @var TwitchUser
     */
    private $user;

    /**
     * @var TwitchChannel
     */
    private $channel;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId(int $id): self
    {
        $this->_id = $id;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $created_at
     *
     * @return $this
     */
    public function setCreatedAt(\DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubPlan(): string
    {
        return $this->sub_plan;
    }

    /**
     * @param string $sub_plan
     *
     * @return $this
     */
    public function setSubPlan(string $sub_plan): self
    {
        $this->sub_plan = $sub_plan;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubPlanName(): string
    {
        return $this->sub_plan_name;
    }

    /**
     * @param string $sub_plan_name
     *
     * @return $this
     */
    public function setSubPlanName(string $sub_plan_name): self
    {
        $this->sub_plan_name = $sub_plan_name;

        return $this;
    }

    /**
     * @return TwitchUser
     */
    public function getUser(): TwitchUser
    {
        return $this->user;
    }

    /**
     * @param TwitchUser $user
     *
     * @return $this
     */
    public function setUser(TwitchUser $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return TwitchChannel
     */
    public function getChannel(): TwitchChannel
    {
        return $this->channel;
    }

    /**
     * @param TwitchChannel $channel
     *
     * @return $this
     */
    public function setChannel(TwitchChannel $channel): self
    {
        $this->channel = $channel;

        return $this;
    }
}