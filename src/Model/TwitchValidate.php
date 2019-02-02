<?php

namespace TwitchApiBundle\Model;

class TwitchValidate extends TwitchModel
{
    /** @var string */
    private $clientId;

    /** @var string */
    private $login;

    /** @var string[] */
    private $scope;

    /** @var string */
    private $userId;

    /** @var TwitchUser */
    private $user;

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string[]
     */
    public function getScope(): array
    {
        return $this->scope;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getUser(): TwitchUser
    {
        return $this->user;
    }

    public function setClientId(string $clientId): TwitchValidate
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function setLogin(string $login): TwitchValidate
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @param string[] $scope
     */
    public function setScope(array $scope): TwitchValidate
    {
        $this->scope = $scope;

        return $this;
    }

    public function setUserId(string $userId): TwitchValidate
    {
        $this->userId = $userId;

        return $this;
    }

    public function setUser(TwitchUser $user): TwitchValidate
    {
        $this->user = $user;

        return $this;
    }
}