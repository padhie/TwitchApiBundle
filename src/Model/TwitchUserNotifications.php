<?php

namespace Padhie\TwitchApiBundle\Model;

final class TwitchUserNotifications implements TwitchModelInterface
{
    /** @var bool */
    private $email;
    /** @var bool */
    private $push;

    private function __construct(bool $email, bool $push)
    {
        $this->email = $email;
        $this->push = $push;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchUserNotifications
    {
        return new self(
            $json['email'] ?? false,
            $json['push'] ?? false
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function isEmail(): bool
    {
        return $this->email;
    }

    public function isPush(): bool
    {
        return $this->push;
    }
}