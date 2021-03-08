<?php

declare(strict_types=1);

namespace Model;

use Padhie\TwitchApiBundle\Model\TwitchModelInterface;

class TwitchReward implements TwitchModelInterface
{
    /** @var string  */
    private $id;
    /** @var string  */
    private $broadcasterName;
    /** @var string  */
    private $broadcasterLogin;
    /** @var string  */
    private $broadcasterId;
    /** @var Images|null  */
    private $image;
    /** @var string  */
    private $backgroundColor;
    /** @var bool  */
    private $is_enabled;
    /** @var int  */
    private $cost;
    /** @var string  */
    private $title;
    /** @var string  */
    private $prompt;
    /** @var bool  */
    private $isUserInputRequired;
    /** @var bool  */
    private $isPaused;
    /** @var bool  */
    private $isInStock;
    /** @var bool  */
    private $shouldRedemptionsSkipRequestQueue;
    /** @var int  */
    private $redemptionsRedeemedCurrentStream;
    /** @var string  */
    private $cooldownExpiresAt;
    /** @var MaxPerUserPerStreamSetting|null  */
    private $maxPerStreamSetting;
    /** @var MaxPerUserPerStreamSetting|null  */
    private $maxPerUserPerStreamSetting;
    /** @var GlobalCooldownSetting|null  */
    private $globalCooldownSetting;
    /** @var Images|null  */
    private $defaultImage;

    private function __construct(
        string $id,
        string $broadcasterName,
        string $broadcasterLogin,
        string $broadcasterId,
        ?Images $image,
        string $backgroundColor,
        bool $is_enabled,
        int $cost,
        string $title,
        string $prompt,
        bool $isUserInputRequired,
        bool $isPaused,
        bool $isInStock,
        bool $shouldRedemptionsSkipRequestQueue,
        int $redemptionsRedeemedCurrentStream,
        string $cooldownExpiresAt,
        ?MaxPerUserPerStreamSetting $maxPerStreamSetting,
        ?MaxPerUserPerStreamSetting $maxPerUserPerStreamSetting,
        ?GlobalCooldownSetting $globalCooldownSetting,
        ?Images $defaultImage
    ) {
        $this->id = $id;
        $this->broadcasterName = $broadcasterName;
        $this->broadcasterLogin = $broadcasterLogin;
        $this->broadcasterId = $broadcasterId;
        $this->image = $image;
        $this->backgroundColor = $backgroundColor;
        $this->is_enabled = $is_enabled;
        $this->cost = $cost;
        $this->title = $title;
        $this->prompt = $prompt;
        $this->isUserInputRequired = $isUserInputRequired;
        $this->isPaused = $isPaused;
        $this->isInStock = $isInStock;
        $this->shouldRedemptionsSkipRequestQueue = $shouldRedemptionsSkipRequestQueue;
        $this->redemptionsRedeemedCurrentStream = $redemptionsRedeemedCurrentStream;
        $this->cooldownExpiresAt = $cooldownExpiresAt;
        $this->maxPerStreamSetting = $maxPerStreamSetting;
        $this->maxPerUserPerStreamSetting = $maxPerUserPerStreamSetting;
        $this->globalCooldownSetting = $globalCooldownSetting;
        $this->defaultImage = $defaultImage;
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function createFromJson(array $json): TwitchReward
    {
        return new self(
            $json['id'] ?? '',
            $json['broadcaster_name'] ?? '',
            $json['broadcaster_login'] ?? '',
            $json['broadcaster_id'] ?? '',
            $json['image'] ? Images::createFromJson($json['image']) : null,
            $json['background_color'] ?? '',
            $json['is_enabled'] ?? false,
            $json['cost'] ?? 0,
            $json['title'] ?? '',
            $json['prompt'] ?? '',
            $json['is_user_input_required'] ?? false,
            $json['is_paused'] ?? false,
            $json['is_in_stock'] ?? true,
            $json['should_redemptions_skip_request_queue'] ?? false,
            $json['redemptions_redeemed_current_stream'] ?? null,
            $json['cooldown_expires_at'] ?? null,
            $json['max_per_stream_setting'] ? MaxPerUserPerStreamSetting::createFromJson($json['max_per_stream_setting']) : null,
            $json['max_per_user_per_stream_setting'] ? MaxPerUserPerStreamSetting::createFromJson($json['max_per_user_per_stream_setting']) : null,
            $json['global_cooldown_setting'] ? GlobalCooldownSetting::createFromJson($json['global_cooldown_setting']) : null,
            $json['default_image'] ? Images::createFromJson($json['default_image']) : null
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
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

    public function getImage(): ?Images
    {
        return $this->image;
    }

    public function getBackgroundColor(): string
    {
        return $this->backgroundColor;
    }

    public function isIsEnabled(): bool
    {
        return $this->is_enabled;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrompt(): string
    {
        return $this->prompt;
    }

    public function isUserInputRequired(): bool
    {
        return $this->isUserInputRequired;
    }

    public function isPaused(): bool
    {
        return $this->isPaused;
    }

    public function isInStock(): bool
    {
        return $this->isInStock;
    }

    public function isShouldRedemptionsSkipRequestQueue(): bool
    {
        return $this->shouldRedemptionsSkipRequestQueue;
    }

    public function getRedemptionsRedeemedCurrentStream(): int
    {
        return $this->redemptionsRedeemedCurrentStream;
    }

    public function getCooldownExpiresAt(): string
    {
        return $this->cooldownExpiresAt;
    }

    public function getMaxPerStreamSetting(): ?MaxPerUserPerStreamSetting
    {
        return $this->maxPerStreamSetting;
    }

    public function getMaxPerUserPerStreamSetting(): ?MaxPerUserPerStreamSetting
    {
        return $this->maxPerUserPerStreamSetting;
    }

    public function getGlobalCooldownSetting(): ?GlobalCooldownSetting
    {
        return $this->globalCooldownSetting;
    }

    public function getDefaultImage(): ?Images
    {
        return $this->defaultImage;
    }
}