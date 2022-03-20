<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Authenticator;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class ValidateResponse implements ResponseInterface
{
    private string $clientId;
    private string $login;
    /** @var array<int, string> */
    private array $scopes = [];
    private string $userId;
    private int $expiresIn;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->clientId = $data['client_id'];
        $self->login = $data['login'];
        $self->scopes = $data['scopes'];
        $self->userId = $data['user_id'];
        $self->expiresIn = $data['expires_in'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'clientId' => $this->clientId,
            'login' => $this->login,
            'scopes' => $this->scopes,
            'userId' => $this->userId,
            'expiresIn' => $this->expiresIn,
        ];
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
     * @return array<int, string>
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }
}