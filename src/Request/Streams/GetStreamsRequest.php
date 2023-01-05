<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request\Streams;

use Padhie\TwitchApiBundle\Request\PaginationRequestInterface;
use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\Streams\GetStreamsResponse;

/**
 * Scope: -
 */
final class GetStreamsRequest implements PaginationRequestInterface
{
    private ?string $after = null;
    private ?string $before = null;
    private ?string $first = null;
    private ?string $gameId = null;
    private ?string $language = null;
    private ?string $userId = null;
    /** @var array<string> */
    private array $userLogins = [];

    public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    public function getUrl(): string
    {
        return 'https://api.twitch.tv/helix/streams';
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getParameter(): array
    {
        $userLoginString = null;
        if (count($this->userLogins) > 0) {
            $userLoginString = $this->userLogins[0];
            if (count($this->userLogins) > 1) {
                $userLogins = $this->userLogins;
                array_shift($userLogins);
                $userLoginString .= '&' . implode('&', array_map(static function (string $item) {
                    return 'userLogin=' . $item;
                }, $userLogins));
            }
        }

        return [
            'after' => $this->after,
            'before' => $this->before,
            'first' => $this->first,
            'game_id' => $this->gameId,
            'language' => $this->language,
            'user_id' => $this->userId,
            'user_login' => $userLoginString,
        ];
    }

    public function getBody(): array
    {
        return [];
    }

    public function getResponseClass(): string
    {
        return GetStreamsResponse::class;
    }

    public function withAfter(string $after): self
    {
        $self = clone $this;
        $self->after = $after;

        return $self;
    }

    public function withBefore(string $before): self
    {
        $self = clone $this;
        $self->before = $before;

        return $self;
    }

    public function withFirst(string $first): self
    {
        $self = clone $this;
        $self->first = $first;

        return $self;
    }

    public function withGameId(string $gameId): self
    {
        $self = clone $this;
        $self->gameId = $gameId;

        return $self;
    }

    public function withLanguage(string $language): self
    {
        $self = clone $this;
        $self->language = $language;

        return $self;
    }

    public function withUserId(string $userId): self
    {
        $self = clone $this;
        $self->userId = $userId;

        return $self;
    }

    public function withUserLogin(string $userLogin): self
    {
        $self = clone $this;
        $self->userLogins[] = $userLogin;

        return $self;
    }
}