<?php

namespace Padhie\TwitchApiBundle\Model;

final class TwitchValidate implements TwitchModelInterface
{
    /** @var string */
    private $clientId;
    /** @var string */
    private $login;
    /** @var string[] */
    private $scopes;
    /** @var string */
    private $userId;
    /** @var null|TwitchUser */
    private $user;

    /**
     * @param array<int, string> $scopes
     */
    private function __construct(string $clientId, string $login, array $scopes, string $userId, ?TwitchUser $user)
    {
        $this->clientId = $clientId;
        $this->login = $login;
        $this->scopes = $scopes;
        $this->userId = $userId;
        $this->user = $user;
    }

    public static function createFromJson(array $json): TwitchValidate
    {
        return new self(
            $json['client_id'] ?? '',
            $json['login'] ?? '',
            $json['scopes'] ?? [],
            $json['user_id'] ?? '',
            $json['user'] ?? null
        );
    }

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
    public function getScopes(): array
    {
        return $this->scopes;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getUser(): ?TwitchUser
    {
        return $this->user;
    }
}