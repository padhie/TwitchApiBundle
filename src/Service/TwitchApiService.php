<?php

namespace Padhie\TwitchApiBundle\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Padhie\TwitchApiBundle\Exception\ApiErrorException;
use Padhie\TwitchApiBundle\Exception\UserNotExistsException;
use Padhie\TwitchApiBundle\Model\Badge;
use Padhie\TwitchApiBundle\Model\TwitchBanedUser;
use Padhie\TwitchApiBundle\Model\TwitchChannel;
use Padhie\TwitchApiBundle\Model\TwitchChannelSubscriptions;
use Padhie\TwitchApiBundle\Model\TwitchEmote;
use Padhie\TwitchApiBundle\Model\TwitchEmoteSet;
use Padhie\TwitchApiBundle\Model\TwitchEmoticonImage;
use Padhie\TwitchApiBundle\Model\TwitchFollower;
use Padhie\TwitchApiBundle\Model\TwitchHost;
use Padhie\TwitchApiBundle\Model\TwitchRedemption;
use Padhie\TwitchApiBundle\Model\TwitchReward;
use Padhie\TwitchApiBundle\Model\TwitchStream;
use Padhie\TwitchApiBundle\Model\TwitchTeam;
use Padhie\TwitchApiBundle\Model\TwitchUser;
use Padhie\TwitchApiBundle\Model\TwitchValidate;
use Padhie\TwitchApiBundle\Model\TwitchVideo;

class TwitchApiService
{
    public const SCOPE_USER = [
        'user_read',
        'user_follows_edit',
    ];
    public const SCOPE_CHANNEL = [
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
        'channel_editor',
        'bits:read',
        'channel:read:redemptions',
        'channel_subscriptions',
        'channel:moderate',
    ];

    private const REQUEST_READ_LIMIT = 8192;
    private const HELIX_API = 'https://api.twitch.tv/helix/';
    private const TMI_API = 'https://tmi.twitch.tv/';

    private Client $guzzle;
    private string $clientId;
    private string $redirectUrl;

    private string $baseUrl = self::HELIX_API;
    private string $headerApplication = 'application/vnd.twitchtv.v5+json';
    private string $oauth = '';
    private ?string $additionalString = null;
    private string $_raw_response = '';
    /** @var array<mixed> */
    private array $response = [];
    private string $lastUrl = '';

    /**
     * @param string $clientSecret deprecated
     */
    public function __construct(string $clientId, string $clientSecret, string $redirectUrl)
    {
        $this->guzzle = new Client();
        $this->clientId = $clientId;
        $this->redirectUrl = $redirectUrl;
    }

    // #########################
    // # SETTER/GETTER METHODS #
    // #########################
    public function setOAuth(string $oauth): self
    {
        $this->oauth = $oauth;

        return $this;
    }

    /**
     * @deprecated
     */
    public function setAdditionalString(string $additional): self
    {
        $this->additionalString = $additional;

        return $this;
    }

    /**
     * @param array<int, string> $scopeList
     */
    public function getAccessTokenUrl(array $scopeList = []): string
    {
        return sprintf(
            '%soauth2/authorize?response_type=token&client_id=%s&scope=%s&redirect_uri=%s',
            $this->baseUrl,
            $this->clientId,
            implode('+', $scopeList),
            $this->redirectUrl
        );
    }

    /**
     * @return mixed[]
     */
    protected function getData(): array
    {
        return $this->response;
    }

    /**
     * @param string[] $header [optional]
     * @return string[]
     */
    private function combineHeader(array $header = []): array
    {
        $authType = $this->baseUrl === self::HELIX_API
            ? 'Bearer'
            : 'OAuth';

        return array_merge(
            [
                'Accept' => $this->headerApplication,
                'Client-ID' => $this->clientId,
                'Authorization' => $authType . ' ' . $this->oauth,
                'Cache-Control' => 'no-cache',
                'Content-Type' => 'application/json',
            ],
            $header
        );
    }

    /**
     * @param array<int|string, int|string|bool> $data
     */
    private function combineGetUrlParameter(array $data): string
    {
        if ($data === []) {
            return '';
        }

        $additionals = [];
        foreach ($data as $key => $value) {
            $additionals[] = is_numeric($key)
                ? $value
                : $key . '=' . $value;
        }

        $additionalString = implode('&', $additionals);

        if ($this->additionalString !== '' && $this->additionalString !== null) {
            return $this->additionalString . '&' . $additionalString;
        }

        return '?' . $additionalString;
    }

    /**
     * @deprecated
     */
    private function useKraken(): void
    {
        throw new \RuntimeException('Twitch-Kraken API not longer supported.');
    }

    private function useHelix(): void
    {
        $this->baseUrl = self::HELIX_API;
    }

    private function useTmi(): void
    {
        $this->baseUrl = self::TMI_API;
    }


    // ################
    // # BASE METHODS #
    // ################
    /**
     * @param array<int|string, int|string|bool> $data [optional] Key => Value
     * @param array<int, string> $header [optional] Value
     * @throws ApiErrorException
     */
    protected function get(string $url_extension, array $data = [], array $header = []): self
    {
        $options = $this->combineHeader($header);
        $this->lastUrl = $this->baseUrl . $url_extension . $this->combineGetUrlParameter($data);

        try {
            $request = new Request('GET', $this->lastUrl, $options);
            $response = $this->guzzle->send($request);
            assert($response instanceof Response);

            $this->loadHoleBody($response);
        } catch (ClientException $e) {
            $this->_raw_response = $e->getResponse() !== null
                ? $e->getResponse()->getBody()->read(self::REQUEST_READ_LIMIT)
                : var_export($e, true);
        } catch (GuzzleException $e) {
            throw new ApiErrorException('Can\'t connect', 1530908311);
        } finally {
            try {
                $this->response = json_decode($this->_raw_response, true, 512, JSON_THROW_ON_ERROR);
            } catch (\Exception $exception) {
            } finally {
                $this->errorCheck();
            }
        }

        return $this;
    }

    /**
     * @param mixed[] $data [optional] Key => Value
     * @param array<int, string> $header [optional] Value
     * @throws ApiErrorException
     */
    protected function post(string $url_extension, array $data = [], array $header = []): self
    {
        $options = $this->combineHeader($header);
        $this->lastUrl = $this->baseUrl . $url_extension . $this->additionalString;
        $body = null;
        try {
            $body = json_encode($data, JSON_THROW_ON_ERROR);
        } catch (\Exception $exception) {
        }

        try {
            $request = new Request('POST', $this->lastUrl, $options, $body);
            $response = $this->guzzle->send($request);
            assert($response instanceof Response);

            $this->loadHoleBody($response);
        } catch (ClientException $e) {
            $this->_raw_response = $e->getResponse() !== null
                ? $e->getResponse()->getBody()->read(self::REQUEST_READ_LIMIT)
                : var_export($e, true);
        } catch (GuzzleException $e) {
            throw new ApiErrorException('Can\'t connect', 1530908311);
        } finally {
            try {
                $this->response = json_decode($this->_raw_response, true, 512, JSON_THROW_ON_ERROR);
            } catch (\Exception $exception) {
            } finally {
                $this->errorCheck();
            }
        }

        return $this;
    }

    /**
     * @param mixed[] $data [optional] Key => Value
     * @param array<int, string> $header [optional] Value
     * @throws ApiErrorException
     */
    protected function put(string $url_extension, array $data = [], array $header = []): self
    {
        $options = $this->combineHeader($header);
        $this->lastUrl = $this->baseUrl . $url_extension . $this->additionalString;
        $body = null;
        try {
            $body = json_encode($data, JSON_THROW_ON_ERROR);
        } catch (\Exception $exception) {
        }

        try {
            $request = new Request('PUT', $this->lastUrl, $options, $body);
            $response = $this->guzzle->send($request);
            assert($response instanceof Response);

            $this->loadHoleBody($response);
        } catch (ClientException $e) {
            $this->_raw_response = $e->getResponse() !== null
                ? $e->getResponse()->getBody()->read(self::REQUEST_READ_LIMIT)
                : var_export($e, true);
        } catch (GuzzleException $e) {
            throw new ApiErrorException('Can\'t connect', 1530908311);
        } finally {
            $this->response = json_decode($this->_raw_response, true);
            $this->errorCheck();
        }

        return $this;
    }

    private function loadHoleBody(Response $response): void
    {
        $this->_raw_response = '';

        $check = true;
        while ($check) {
            $tmpRawResponse = $response->getBody()->read(self::REQUEST_READ_LIMIT);
            $this->_raw_response .= $tmpRawResponse;
            if (strlen($tmpRawResponse) < self::REQUEST_READ_LIMIT) {
                $check = false;
            }
        }
    }

    /**
     * @throws ApiErrorException
     */
    private function errorCheck(): void
    {
        if (isset($this->response['error'])) {
            $message = $this->response['message'];
            if (empty($message)) {
                $message = $this->response['error'];
            }

            throw new ApiErrorException($this->lastUrl . ' - ' . $message, $this->response['status']);
        }
    }

    // #######################
    // # GENERAL API METHODS #
    // #######################
    public function validate(): TwitchValidate
    {
        $_tmpBaseUrl = $this->baseUrl;
        $this->baseUrl = 'https://id.twitch.tv/oauth2/validate';
        $this->get('');
        $this->baseUrl = $_tmpBaseUrl;

        $validateData = $this->getData();
        $validateData['user'] = $this->getUserByName($validateData['login']);

        return TwitchValidate::createFromJson($validateData);
    }

    // ################
    // # USER METHODS #
    // ################
    /**
     * @param string[] $names
     * @return TwitchUser[]
     * @throws ApiErrorException
     * @throws UserNotExistsException
     * @deprecated use getUserByName
     * Scope: user_read
     */
    public function getUsersByName(array $names): array
    {
        $results = [];
        foreach ($names as $name) {
            $results[] = $this->getUserByName($name);
        }

        return array_filter($results);
    }

    /**
     * Scope: user_read
     * @throws ApiErrorException
     * @throws UserNotExistsException
     */
    public function getUserByName(string $name): ?TwitchUser
    {
        $this->useHelix();

        $this->get('users', ['login' => $name]);

        $response = $this->getData();
        $data = $response['data'];

        return count($data) > 0
            ? TwitchUser::createFromJson($data[0])
            : null;
    }

    /**
     * @throws ApiErrorException
     * @deprecated use getUserById
     * Scope: user_read
     */
    public function getUser(int $userId): ?TwitchUser
    {
        return $this->getUserById($userId);
    }

    /**
     * Scope: -
     * @throws ApiErrorException
     */
    public function getUserById(int $userId): ?TwitchUser
    {
        $this->useHelix();

        $this->get('users', ['id' => $userId]);

        $response = $this->getData();
        $data = $response['data'];

        return count($data) > 0
            ? TwitchUser::createFromJson($data[0])
            : null;
    }

    /**
     * Scope: channel_subscriptions
     * @throws ApiErrorException
     */
    public function getChannelSubscriber(int $channelId): TwitchChannelSubscriptions
    {
        $pageCursor = null;
        $subscriptions = [];

        while (true) {
            $parameter = array_filter([
                'broadcaster_id' => $channelId,
                'first' => 100,
                'after' => $pageCursor,
            ]);

            $this->get('/subscriptions', $parameter);

            $responseData = $this->getData();
            $pageCursor = $responseData['pagination']['cursor'] ?? null;
            $total = $responseData['total'];
            $points = $responseData['points'];

            $data = $responseData['data'];
            $subscriptions = array_merge($subscriptions, $data);

            if ($pageCursor === null || count($data) === 0 || $total <= count($subscriptions)) {
                break;
            }
        }

        return TwitchChannelSubscriptions::createFromJson([
            'subscriptions' => $subscriptions,
            'total' => $total ?? 0,
            'points' => $points ?? 0,
        ]);
    }

    /**
     * Scope: user_subscriptions
     */
    public function isUserSubscribingChannel(int $userId, int $channelId): bool
    {
        $this->useHelix();

        $this->get('subscriptions/user', ['broadcaster_id' => $channelId, 'user_id' => $userId]);

        $response = $this->getData();
        $data = $response['data'];

        return count($data) > 0;
    }

    /**
     * Scope: -
     * @return array<int, TwitchFollower>
     */
    public function getUserFollowingChannel(int $channelId): array
    {
        $this->useHelix();

        $pageCursor = null;
        $followers = [];

        while(true) {
            $parameter = array_filter([
                'to_id' => $channelId,
                'first' => 100,
                'after' => $pageCursor
            ]);

            $this->get('users/follows/', $parameter);

            $response = $this->getData();
            $data = $response['data'];
            $pageCursor = $response['pagination']['cursor'] ?? null;

            foreach ($data as $row) {
                $followers[] = TwitchFollower::createFromJson($row);
            }

            if ($pageCursor === null || count($data) === 0) {
                break;
            }
        }

        return $followers;
    }

    /**
     * Scope: -
     */
    public function isUserFollowingChannel(int $userId, int $channelId): bool
    {
        $this->useHelix();

        $parameter = array_filter([
            'first' => 1,
            'from_id' => $userId,
            'to_id' => $channelId,
        ]);

        $this->get('users/follows/', $parameter);

        $response = $this->getData();
        $data = $response['data'];

        return count($data) > 0;
    }

    /**
     * @deprecated
     * @return TwitchFollower[]
     * @throws ApiErrorException
     * @deprecated
     * Scope: -
     */
    public function getChannelFollower(int $userId): array
    {
        $this->useKraken();

        $this->get('users/' . $userId . '/follows/channels');

        $followerList = [];
        foreach ($this->getData()['follows'] as $followerData) {
            $followerList[] = TwitchFollower::createFromJson($followerData);
        }

        return $followerList;
    }

    /**
     * @deprecated
     * Scope: user_follows_edit
     * @throws ApiErrorException
     */
    public function setUserFollowingChannel(int $userId, int $channelId): TwitchChannel
    {
        $this->useKraken();

        $this->put('users/' . $userId . '/follows/channels/' . $channelId);

        return TwitchChannel::createFromJson($this->getData());
    }


    // ###################
    // # CHANNEL METHODS #
    // ###################
    /**
     * @throws ApiErrorException
     * @deprecated use getChannelById
     * Scope: channel_read
     */
    public function getChannel(int $channelId): TwitchChannel
    {
        return $this->getChannelById($channelId);
    }

    /**
     * Scope: -
     * @throws ApiErrorException
     */
    public function getChannelById(int $channelId): TwitchChannel
    {
        $this->useHelix();

        $this->get('channel', ['broadcaster_id' => $channelId]);

        return TwitchChannel::createFromJson($this->getData());
    }

    /**
     * @deprecated use getFollowers
     * Scope: -
     * @return TwitchFollower[]
     * @throws ApiErrorException
     */
    public function getFollowerList(int $userId): array
    {
        return $this->getFollowers($userId);
    }

    /**
     * Scope: -
     * @return TwitchFollower[]
     * @throws ApiErrorException
     */
    public function getFollowers(int $userId): array
    {
        $this->useHelix();

        $pageCursor = null;
        $followers = [];

        while(true) {
            $parameter = array_filter([
                'from_id' => $userId,
                'first' => 100,
                'after' => $pageCursor
            ]);

            $this->get('users/follows/', $parameter);

            $response = $this->getData();
            $data = $response['data'];
            $pageCursor = $response['pagination']['cursor'] ?? null;

            foreach ($data as $row) {
                $followers[] = TwitchFollower::createFromJson($row);
            }

            if ($pageCursor === null || count($data) === 0) {
                break;
            }
        }

        return $followers;
    }

    /**
     * Scope: -
     * @return TwitchTeam[]
     * @throws ApiErrorException
     */
    public function getTeamList(int $channelId): array
    {
        $this->useHelix();

        $this->get('teams/channel', ['broadcaster_id' => $channelId]);

        $teamList = [];
        foreach ($this->getData()['data'] as $teamData) {
            $teamList[] = TwitchTeam::createFromJson($teamData);
        }

        return $teamList;
    }

    /**
     * Scope: channel_editor
     * @throws ApiErrorException
     */
    public function changeChannelTitle(string $title, int $channelId): TwitchChannel
    {
        $this->useHelix();

        $data = [
            'channel' => [
                'status' => $title,
            ],
        ];

        $this->put('channels/' . $channelId, $data);

        return TwitchChannel::createFromJson($this->getData());
    }

    /**
     * Scope: channel_editor
     * @throws ApiErrorException
     */
    public function changeChannelGame(string $game, int $channelId): TwitchChannel
    {
        $this->useHelix();

        $data = [
            'channel' => [
                'game' => $game,
            ],
        ];

        $this->put('channels/' . $channelId, $data);

        return TwitchChannel::createFromJson($this->getData());
    }

    /**
     * Scope: -
     * @return TwitchHost[]
     * @throws ApiErrorException
     */
    public function getHosts(): array
    {
        $this->useTmi();

        $this->get('hosts?include_logins=1&target=' . $this->getChannelId(), [], ['Cache-Control: no-cache']);

        $data = $this->getData();
        $hostList = [];
        foreach ($data['hosts'] as $host) {
            $itemData = [
                'channel' => $this->getChannelById($host['host_id']),
                'target' => $this->getChannelById($host['target_id']),
                'viewer' => 0,
            ];

            if (isset($host['host_recent_chat_activity_count'])) {
                $itemData['viewer']++;
            }

            $hostList[] = TwitchHost::createFromJson($itemData);
        }

        return $hostList;
    }


    // ##################
    // # STREAM METHODS #
    // ##################
    /**
     * Scope: -
     * @throws ApiErrorException
     */
    public function getStream(int $channelId): ?TwitchStream
    {
        $this->useHelix();

        $this->get('streams/', ['user_id' => $channelId]);

        $responseData = $this->getData();
        $data = $responseData['data'];

        if (count($data) === 0) {
            return null;
        }

        return TwitchStream::createFromJson($data[0]);
    }

    /**
     * @deprecated
     * Scope: user_read
     * @return TwitchStream[]
     * @throws ApiErrorException
     */
    public function getFollowingStreamList(): array
    {
        $this->useKraken();

        $this->get('streams/followed', ['stream_type' => 'all']);

        $streamList = [];
        foreach ($this->getData()['streams'] as $streamData) {
            $streamList[] = TwitchStream::createFromJson($streamData);
        }

        return $streamList;
    }


    // ##################
    // # REWARD METHODS #
    // ##################
    /**
     * Scope: channel:manage:redemptions
     * @param mixed[] $data [Optional] Optional parameter for reward
     * @return TwitchReward[]
     * @throws ApiErrorException
     */
    public function createCustomReward(int $broadcasterId, string $title, int $cost, array $data = []): array
    {
        $this->useHelix();

        $body = array_filter([
            // require parameter
            'title' => $title,
            'cost' => $cost,
            // optional parameter
            'prompt' => $data['prompt'],
            'is_enabled' => $data['is_enabled'],
            'background_color' => $data['background_color'],
            'is_user_input_required' => $data['is_user_input_required'],
            'is_max_per_stream_enabled' => $data['is_max_per_stream_enabled'],
            'max_per_stream' => $data['max_per_stream'],
            'is_max_per_user_per_stream_enabled' => $data['is_max_per_user_per_stream_enabled'],
            'max_per_user_per_stream' => $data['max_per_user_per_stream'],
            'is_global_cooldown_enabled' => $data['is_global_cooldown_enabled'],
            'global_cooldown_seconds' => $data['global_cooldown_seconds'],
            'should_redemptions_skip_request_queue' => $data['should_redemptions_skip_request_queue'],
        ]);

        $this->post('channel_points/custom_rewards?broadcaster_id=' . $broadcasterId, $body);

        $result = [];
        foreach ($this->getData()['data'] ?? [] as $responseData) {
            $result[] = TwitchReward::createFromJson($responseData);
        }

        return $result;
    }

    /**
     * Scope: channel:read:redemptions
     * @return TwitchReward[]
     * @throws ApiErrorException
     */
    public function getCustomReward(int $broadcasterId, bool $onlyManageableRewards = false): array
    {
        $this->useHelix();

        $param = [
            'broadcaster_id' => $broadcasterId,
            'only_manageable_rewards' => $onlyManageableRewards,
        ];

        $this->get('channel_points/custom_rewards', $param);

        $result = [];
        foreach ($this->getData()['data'] ?? [] as $responseData) {
            $result[] = TwitchReward::createFromJson($responseData);
        }

        return $result;
    }

    /**
     * Scope: channel:read:redemptions
     * @return TwitchRedemption[]
     * @throws ApiErrorException
     */
    public function getCustomRewardRedemption(int $broadcasterId): array
    {
        $this->useHelix();

        $param = [
            'broadcaster_id' => $broadcasterId,
        ];

        $this->get('channel_points/custom_rewards/redemptions', $param);

        $result = [];
        foreach ($this->getData()['data'] ?? [] as $responseData) {
            $result[] = TwitchRedemption::createFromJson($responseData);
        }

        return $result;
    }

    // ################
    // # CHAT METHODS #
    // ################
    /**
     * Scope: -
     * @return mixed[]
     * @throws ApiErrorException
     */
    public function getBadgeList(int $channelId): array
    {
        $this->useHelix();

        $this->get('chat/badges', ['broadcaster_id' => $channelId]);

        $result = [];
        foreach ($this->getData() as $responseData) {
            $result[] = Badge::createFromJson($responseData);
        }

        return $result;
    }

    /**
     * Scope: -
     * @return string
     * @throws ApiErrorException
     */
    public function getUserList(string $channelName): string
    {
        $this->useTmi();

        $this->get('group/user/' . $channelName . '/chatters', [], ['Cache-Control: no-cache']);

        return $this->_raw_response;
    }

    /**
     * @return TwitchEmote[]
     * @throws ApiErrorException
     * @deprecated use getEmotes
     * Scope: -
     * @deprecated
     */
    public function getEmoticonList(int $channelId): array
    {
        return $this->getEmotes($channelId);
    }

    /**
     * @return TwitchEmote[]
     * @throws ApiErrorException
     * @deprecated use getEmotes
     * Scope: -
     */
    public function getEmoticonImageList(int $channelId): array
    {
        return $this->getEmotes($channelId);
    }

    /**
     * Scope: -
     * @return TwitchEmote[]
     * @throws ApiErrorException
     */
    public function getEmotes(int $channelId): array
    {
        $this->useHelix();

        $this->get('chat/emotes', ['broadcaster_id' => $channelId]);

        $emotes = [];
        foreach ($this->getData() as $emotes) {
            $emotes[] = TwitchEmote::createFromJson($emotes);
        }

        return $emotes;
    }

    /**
     * @param string $emoticonSetIds List of emoticonsets with , (comma) seperated
     * @return TwitchEmoteSet[]
     * @throws ApiErrorException
     * @deprecated use getEmotesByEmoteSetIds
     * Scope: -
     */
    public function getEmoticonImageListByEmoteiconSets(string $emoticonSetIds): array
    {
        return $this->getEmotesByEmoteSetIds($emoticonSetIds);
    }

    /**
     * Scope: -
     * @param string $emoticonSetIds List of emoticonsets with , (comma) seperated
     * @return TwitchEmoteSet[]
     * @throws ApiErrorException
     */
    public function getEmotesByEmoteSetIds(string $emoticonSetIds): array
    {
        $this->useHelix();

        $this->get('chat/emotes/set', explode(',', $emoticonSetIds));

        $emoticonList = [];
        foreach ($this->getData()['emoticon_sets'] as $id => $emoticonsData) {
            foreach ($emoticonsData as $data) {
                $emoticonList[] = TwitchEmoteSet::createFromJson($data);

            }
        }

        return $emoticonList;
    }


    // #################
    // # VIDEO METHODS #
    // #################
    /**
     * Scope: -
     * @throws ApiErrorException
     */
    public function getVideoById(int $videoId, int $channelId): TwitchVideo
    {
        $this->useHelix();

        $this->get('videos/', ['id' => $videoId]);

        $data = $this->getData();
        $data['channel'] = $this->getChannelById($channelId);

        return TwitchVideo::createFromJson($data);
    }

    // #####################
    // # MODERATOR METHODS #
    // #####################
    /**
     * Scope: moderation:read
     * @return TwitchBanedUser[]
     * @throws ApiErrorException
     */
    public function getBannedUser(int $channelId): array
    {
        $this->useHelix();

        $bannedUser = [];
        $pagCursor = null;

        while (true) {
            $this->get(
                'moderation/banned',
                array_filter([
                    'broadcaster_id' => $channelId,
                    'first' => 100,
                    'after' => $pagCursor,
                ])
            );

            $responseData = $this->getData();
            $pagCursor = $responseData['pagination']['cursor'] ?? null;
            $data = $responseData['data'];

            foreach ($data as $userItem) {
                $bannedUser[] = TwitchBanedUser::createFromJson($userItem);
            }

            if (count($data) === 0 || $pagCursor === null) {
                break;
            }
        }

        return $bannedUser;
    }
}