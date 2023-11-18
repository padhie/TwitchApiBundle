<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\ChannelPoints;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class CustomReward implements ResponseInterface
{
    private string $broadcasterName;
    private string $broadcasterLogin;
    private string $broadcasterId;
    private string $id;
    private ?Image $image = null;
    private string $backgroundColor;
    private bool $isEnabled;
    private ?int $cost = null;
    private string $title;
    private string $prompt;
    private bool $isUserInputRequired;
    private MaxPerStreamSetting $maxPerStreamSetting;
    private MaxPerUserPerStreamSetting  $maxPerUserPerStreamSetting;
    private GlobalCooldownSetting $globalCooldownSetting;
    private bool $isPaused;
    private bool $isInStock;
    private Image $defaultImage;
    private bool $shouldRedemptionsSkipRequestQueue;
    private ?int $redemptionsRedeemedCurrentStream = null;
    private string $cooldownExpiresAt;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->broadcasterName = $data['broadcaster_name'];
        $self->broadcasterLogin = $data['broadcaster_login'];
        $self->broadcasterId = $data['broadcaster_id'];
        $self->id = $data['id'];
        $self->image = $data['image'] !== null ? Image::createFromArray($data['image']) : null;
        $self->backgroundColor = $data['background_color'];
        $self->isEnabled = $data['is_enabled'];
        $self->cost = $data['cost'];
        $self->title = $data['title'];
        $self->prompt = $data['prompt'];
        $self->isUserInputRequired = $data['is_user_input_required'];
        $self->maxPerStreamSetting = MaxPerStreamSetting::createFromArray($data['max_per_stream_setting']);
        $self->maxPerUserPerStreamSetting = MaxPerUserPerStreamSetting::createFromArray($data['max_per_user_per_stream_setting']);
        $self->globalCooldownSetting = GlobalCooldownSetting::createFromArray($data['global_cooldown_setting']);
        $self->isPaused = $data['is_paused'];
        $self->isInStock = $data['is_in_stock'];
        $self->defaultImage = Image::createFromArray($data['default_image']);
        $self->shouldRedemptionsSkipRequestQueue = $data['should_redemptions_skip_request_queue'];
        $self->redemptionsRedeemedCurrentStream = $data['redemptions_redeemed_current_stream'];
        $self->cooldownExpiresAt = $data['cooldown_expires_at'];

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'broadcasterName' => $this->broadcasterName,
            'broadcasterLogin' => $this->broadcasterLogin,
            'broadcasterId' => $this->broadcasterId,
            'id' => $this->id,
            'image' => $this->image,
            'backgroundColor' => $this->backgroundColor,
            'isEnabled' => $this->isEnabled,
            'cost' => $this->cost,
            'title' => $this->title,
            'prompt' => $this->prompt,
            'isUserInputRequired' => $this->isUserInputRequired,
            'maxPerStreamSetting' => $this->maxPerStreamSetting,
            'maxPerUserPerStreamSetting' => $this->maxPerUserPerStreamSetting,
            'globalCooldownSetting' => $this->globalCooldownSetting,
            'isPaused' => $this->isPaused,
            'isInStock' => $this->isInStock,
            'defaultImage' => $this->defaultImage,
            'shouldRedemptionsSkipRequestQueue' => $this->shouldRedemptionsSkipRequestQueue,
            'redemptionsRedeemedCurrentStream' => $this->redemptionsRedeemedCurrentStream,
            'cooldownExpiresAt' => $this->cooldownExpiresAt,
        ];
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

    public function getId(): string
    {
        return $this->id;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function getBackgroundColor(): string
    {
        return $this->backgroundColor;
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function getCost(): ?int
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

    public function getMaxPerStreamSetting(): MaxPerStreamSetting
    {
        return $this->maxPerStreamSetting;
    }

    public function getMaxPerUserPerStreamSetting(): MaxPerUserPerStreamSetting
    {
        return $this->maxPerUserPerStreamSetting;
    }

    public function getGlobalCooldownSetting(): GlobalCooldownSetting
    {
        return $this->globalCooldownSetting;
    }

    public function isPaused(): bool
    {
        return $this->isPaused;
    }

    public function isInStock(): bool
    {
        return $this->isInStock;
    }

    public function getDefaultImage(): Image
    {
        return $this->defaultImage;
    }

    public function isShouldRedemptionsSkipRequestQueue(): bool
    {
        return $this->shouldRedemptionsSkipRequestQueue;
    }

    public function getRedemptionsRedeemedCurrentStream(): ?int
    {
        return $this->redemptionsRedeemedCurrentStream;
    }

    public function getCooldownExpiresAt(): string
    {
        return $this->cooldownExpiresAt;
    }
}