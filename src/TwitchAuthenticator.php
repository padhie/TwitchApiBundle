<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle;

final readonly class TwitchAuthenticator
{
    /**
     * analytics:read:extensions
     * analytics:read:games
     *
     * bits:read
     *
     * clips:edit
     *
     * channel:edit:commercial
     * channel:manage:broadcast
     * channel:manage:polls
     * channel:manage:predictions
     * channel:manage:redemptions
     * channel:manage:schedule
     * channel:manage:videos
     * channel:read:editors
     * channel:read:hype_train
     * channel:read:polls
     * channel:read:predictions
     * channel:read:redemptions
     * channel:read:stream_key
     * channel:read:subscriptions
     *
     * user:edit
     * user:edit:broadcast
     * user:manage:blocked_users
     * user:read:blocked_users
     * user:read:broadcast
     * user:read:follows
     *
     * moderation:read
     *
     * moderator:manage:automod
     */

    public const SCOPE_USER = [
        'user:read:blocked_users',
        'user:read:broadcast',
        'user:read:follows',
        'user:edit',
        // legacy scopes
        'user_read',
        'user_follows_edit',
    ];
    public const SCOPE_CHANNEL = [
        'channel:edit:commercial',
        'channel:manage:broadcast',
        'channel:manage:polls',
        'channel:manage:predictions',
        'channel:manage:redemptions',
        'channel:manage:schedule',
        'channel:manage:videos',
        'channel:read:editors',
        'channel:read:hype_train',
        'channel:read:polls',
        'channel:read:predictions',
        'channel:read:redemptions',
        'channel:read:stream_key',
        'channel:read:subscriptions',
        // legacy scopes
        'channel_read',
        'channel_stream',
        'channel_editor',
        'channel_subscriptions',
        'channel_check_subscription',
        'channel_commercial',
    ];
    public const SCOPE_MODERATOR = [
        'moderation:read',
    ];
    public const SCOPE_PUBSUB = [
        'bits:read',
        'channel:edit:commercial',
        'channel:read:redemptions',
        'channel:read:subscriptions',
        // legacy scopes
        'channel_editor',
        'channel_subscriptions',
        'channel:moderate',
    ];

    public function __construct(private string $clientId, private string $redirectUrl)
    {
    }

    /**
     * @param array<int, string> $scopeList
     */
    public function getAccessTokenUrl(array $scopeList = []): string
    {
        return sprintf(
            'https://id.twitch.tv/oauth2/authorize?response_type=token&client_id=%s&scope=%s&redirect_uri=%s',
            $this->clientId,
            implode('+', $scopeList),
            $this->redirectUrl
        );
    }
}