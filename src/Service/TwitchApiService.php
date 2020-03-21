<?php

namespace Padhie\TwitchApiBundle\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Padhie\TwitchApiBundle\Exception\ApiErrorException;
use Padhie\TwitchApiBundle\Exception\UserNotExistsException;
use Padhie\TwitchApiBundle\Model\TwitchChannel;
use Padhie\TwitchApiBundle\Model\TwitchChannelSubscriptions;
use Padhie\TwitchApiBundle\Model\TwitchEmoticon;
use Padhie\TwitchApiBundle\Model\TwitchEmoticonImage;
use Padhie\TwitchApiBundle\Model\TwitchFollower;
use Padhie\TwitchApiBundle\Model\TwitchHost;
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
    private const REQUEST_READ_LIMIT = 8192;

    /** @var Client */
    private $guzzle;
    /** @var string */
    private $client_id;
    /** @var string */
    private $client_secret;
    /** @var string */
    private $redirect_url;
    /** @var string */
    private $base_url = 'https://api.twitch.tv/kraken/';
    /** @var string */
    private $header_application = 'application/vnd.twitchtv.v5+json';
    /** @var string */
    private $oauth;
    /** @var string */
    private $additional_string;
    /** @var string */
    private $_raw_response;
    /** @var array<mixed> */
    private $response;
    /** @var integer */
    private $channel_id;
    /** @var string */
    private $channel_name;
    /** @var integer */
    private $user_id;
    /** @var integer */
    private $video_id;
    /** @var string */
    private $last_url;

    public function __construct(string $clientId, string $clientSecret, string $redirectUrl)
    {
        $this->guzzle = new Client();
        $this->client_id = $clientId;
        $this->client_secret = $clientSecret;
        $this->redirect_url = $redirectUrl;
    }

    // #########################
    // # SETTER/GETTER METHODS #
    // #########################
    public function setOAuth(string $oauth): self
    {
        $this->oauth = $oauth;

        return $this;
    }

    public function setAdditionalString(string $additional): self
    {
        $this->additional_string = $additional;

        return $this;
    }

    /**
     * @param array<int, string> $scopeList
     */
    public function getAccessTokenUrl(array $scopeList = []): string
    {
        $scope = implode('+', $scopeList);

        $sUrl = $this->base_url . 'oauth2/authorize?';
        $sParams = 'response_type=token' .
            '&client_id=' . $this->client_id .
            '&scope=' . $scope .
            '&redirect_uri=' . $this->redirect_url;

        return $sUrl . $sParams;
    }

    public function setChannelId(int $channelId): self
    {
        $this->channel_id = $channelId;

        return $this;
    }

    public function getChannelId(): int
    {
        return $this->channel_id;
    }

    public function setChannelName(string $channelName): self
    {
        $this->channel_name = $channelName;

        return $this;
    }

    public function getChannelName(): string
    {
        return $this->channel_name;
    }

    public function setUserId(int $userId): self
    {
        $this->user_id = $userId;

        return $this;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setVideoId(int $videoId): self
    {
        $this->video_id = $videoId;

        return $this;
    }

    public function getVideoId(): int
    {
        return $this->video_id;
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
        return array_merge($header, [
            'Accept' => $this->header_application,
            'Client-ID' => $this->client_id,
            'Authorization' => 'OAuth ' . $this->oauth,
            'Cache-Control' => 'no-cache',
        ]);
    }


    // ################
    // # BASE METHODS #
    // ################
    /**
     * @param array<string, string> $data [optional] Key => Value
     * @param array<int, string> $header [optional] Value
     * @return TwitchApiService
     * @throws ApiErrorException
     */
    protected function get(string $url_extension, array $data = [], array $header = []): self
    {
        $additional_string = $this->additional_string;
        if (is_array($data) && !empty($data)) {
            $dataList = [];
            foreach ($data AS $key => $value) {
                $dataList[] = $key . '=' . $value;
            }
            $additional_string .= '?' . implode("&", $dataList);
        }

        $options = $this->combineHeader($header);
        $this->last_url = $this->base_url . $url_extension . $additional_string;

        try {
            $request = new Request('GET', $this->last_url, $options);
            $response = $this->guzzle->send($request);
            assert($response instanceof Response);

            $this->loadHoleBody($response);
        } catch (ClientException $e) {
            $this->_raw_response =
                $e->getResponse() !== null
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

    /**
     * @param array<string, string> $data [optional] Key => Value
     * @param array<int, string> $header [optional] Value
     * @return TwitchApiService
     * @throws ApiErrorException
     */
    protected function put(string $url_extension, array $data = [], array $header = []): self
    {
        $options = array_merge($this->combineHeader($header), ['body' => $data]);
        $this->last_url = $this->base_url . $url_extension . $this->additional_string;

        try {
            $request = new Request('PUT', $this->last_url, $options);
            $response = $this->guzzle->send($request);
            assert($response instanceof Response);

            $this->loadHoleBody($response);
            $this->response = json_decode($this->_raw_response, true);
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
            $tmpRawRespnse = $response->getBody()->read(self::REQUEST_READ_LIMIT);
            $this->_raw_response .= $tmpRawRespnse;
            if (strlen($tmpRawRespnse) < self::REQUEST_READ_LIMIT) {
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
            throw new ApiErrorException($this->last_url . ' - ' . $message, $this->response['status']);
        }
    }

    // #######################
    // # GENERAL API METHODS #
    // #######################
    public function validate(): TwitchValidate
    {
        $_tmpBaseUrl = $this->base_url;
        $this->base_url = 'https://id.twitch.tv/oauth2/validate';
        $this->get('');
        $this->base_url = $_tmpBaseUrl;

        $validateData = $this->getData();
        $validateData['user'] = $this->getUserByName($validateData['login']);

        return TwitchValidate::createFromJson($validateData);
    }

    // ################
    // # USER METHODS #
    // ################
    /**
     * Scope: user_read
     * @throws ApiErrorException
     * @throws UserNotExistsException
     */
    public function getUserByName(string $name): TwitchUser
    {
        $this->get('users?login=' . $name);

        if (!isset($this->getData()['users'][0])) {
            throw new UserNotExistsException('No userdata exists', 1530903951);
        }

        return TwitchUser::createFromJson($this->getData()['users'][0]);
    }

    /**
     * Scope: user_read
     * @throws ApiErrorException
     */
    public function getUser(): TwitchUser
    {
        $this->get('user');

        return TwitchUser::createFromJson($this->getData());
    }

    /**
     * Scope: -
     * @throws ApiErrorException
     */
    public function getUserById(int $userId = 0): TwitchUser
    {
        $userId = $userId > 0 ? $userId : $this->getUserId();
        $this->get('users/' . $userId);

        return TwitchUser::createFromJson($this->getData());
    }

    /**
     * Scope: channel_subscriptions
     * @throws ApiErrorException
     */
    public function getChannelSubscriber(int $channelId = 0): TwitchChannelSubscriptions
    {
        $channelId = $channelId > 0 ? $channelId : $this->getChannelId();
        $this->get('channels/' . $channelId . '/subscriptions');

        $data = $this->getData();
        $channel = $this->getChannelById($channelId);

        foreach ($data['subscriptions'] ?? [] as $index => $item) {
            $data['subscriptions'][$index]['channel'] = $channel->jsonSerialize();
        }

        return TwitchChannelSubscriptions::createFromJson($data);
    }

    /**
     * Scope: user_subscriptions
     */
    public function isUserSubscribingChannel(int $userId = 0, int $channelId = 0): bool
    {
        $userId = $userId > 0 ? $userId : $this->getUserId();
        $channelId = $channelId > 0 ? $channelId : $this->getChannelId();
        try {
            $this->get('users/' . $userId . '/subscriptions/' . $channelId);
            $data = $this->getData();
            if (!isset($data['_total']) || $data['_total'] === 0) {
                return false;
            }
        } catch (ApiErrorException $e) {
            if (strpos($e->getMessage(), 'no subscriptions')) {
                return false;
            }

            throw new $e;
        }

        return true;
    }

    /**
     * Scope: -
     */
    public function getUserFollowingChannel(): TwitchFollower
    {
        $this->isUserFollowingChannel();
        $data = $this->getData();
        $data['user'] = $this->getUser();
        $data['channel'] = $this->getChannel();

        return TwitchFollower::createFromJson($data);
    }

    /**
     * Scope: -
     */
    public function isUserFollowingChannel(int $userId = 0, int $channelId = 0): bool
    {
        $userId = $userId > 0 ? $userId : $this->getUserId();
        $channelId = $channelId > 0 ? $channelId : $this->getChannelId();
        try {
            $this->get('users/' . $userId . '/follows/channels/' . $channelId);
        } catch (ApiErrorException $e) {
            if (strpos($e->getMessage(), 'is not following')
                || strpos($e->getMessage(), 'Follow not found')) {
                return false;
            }

            throw new $e;
        }

        return true;
    }

    /**
     * Scope: -
     * @return TwitchFollower[]
     * @throws ApiErrorException
     */
    public function getChannelFollower(int $userId = 0): array
    {
        $userId = $userId > 0 ? $userId : $this->getUserId();
        $this->get('users/' . $userId . '/follows/channels');

        $followerList = [];
        foreach ($this->getData()['follows'] AS $followerData) {
            $followerList[] = TwitchFollower::createFromJson($followerData);
        }

        return $followerList;
    }

    /**
     * Scope: user_follows_edit
     * @throws ApiErrorException
     */
    public function setUserFollowingChannel(int $userId = 0, int $channelId = 0): TwitchChannel
    {
        $userId = $userId > 0 ? $userId : $this->getUserId();
        $channelId = $channelId > 0 ? $channelId : $this->getChannelId();
        $this->put('users/' . $userId . '/follows/channels/' . $channelId);

        return TwitchChannel::createFromJson($this->getData());
    }


    // ###################
    // # CHANNEL METHODS #
    // ###################
    /**
     * Scope: channel_read
     * @throws ApiErrorException
     */
    public function getChannel(): TwitchChannel
    {
        $this->get('channel');

        return TwitchChannel::createFromJson($this->getData());
    }

    /**
     * Scope: -
     * @throws ApiErrorException
     */
    public function getChannelById(int $channelId = 0): TwitchChannel
    {
        $channelId = $channelId > 0 ? $channelId : $this->getChannelId();
        $this->get('channels/' . $channelId);

        return TwitchChannel::createFromJson($this->getData());
    }

    /**
     * Scope: -
     * @return TwitchFollower[]
     * @throws ApiErrorException
     */
    public function getFollowerList(int $channelId = 0): array
    {
        $channelId = $channelId > 0 ? $channelId : $this->getChannelId();
        $this->get('channels/' . $channelId . '/follows');

        $followerList = [];
        foreach ($this->getData()['follows'] AS $followerData) {
            $followerList[] = TwitchFollower::createFromJson($followerData);
        }

        return $followerList;
    }

    /**
     * Scope: -
     * @return TwitchTeam[]
     * @throws ApiErrorException
     */
    public function getTeamList(int $channelId = 0): array
    {
        $channelId = $channelId > 0 ? $channelId : $this->getChannelId();
        $this->get('channels/' . $channelId . '/team');

        $teamList = [];
        foreach ($this->getData()['follows'] AS $teamData) {
            $teamList[] = TwitchTeam::createFromJson($teamData);
        }

        return $teamList;
    }

    /**
     * Scope: channel_editor
     * @throws ApiErrorException
     */
    public function changeChannelTitle(string $title, int $channelId = 0): TwitchChannel
    {
        $data = [
            'channel[status]' => $title,
        ];

        $channelId = $channelId > 0 ? $channelId : $this->getChannelId();
        $this->put('channels/' . $channelId, $data);

        return TwitchChannel::createFromJson($this->getData());
    }

    /**
     * Scope: channel_editor
     * @throws ApiErrorException
     */
    public function changeChannelGame(string $game, int $channelId = 0): TwitchChannel
    {
        $data = [
            'channel[game]' => $game,
        ];

        $channelId = $channelId > 0 ? $channelId : $this->getChannelId();
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
        $_tmpBaseUrl = $this->base_url;
        $this->base_url = 'https://tmi.twitch.tv/';
        $this->get('hosts?include_logins=1&target=' . $this->getChannelId(), [], ['Cache-Control: no-cache']);
        $this->base_url = $_tmpBaseUrl;

        $data = $this->getData();
        $hostList = [];
        foreach ($data['hosts'] AS $host) {
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
    public function getStream(int $channelId = 0): ?TwitchStream
    {
        $channelId = $channelId > 0 ? $channelId : $this->getChannelId();
        $this->get('streams/' . $channelId);
        $returnData = $this->getData();

        if ($returnData['stream']) {
            return TwitchStream::createFromJson($returnData['stream']);
        }

        return null;
    }

    /**
     * Scope: user_read
     * @return TwitchStream[]
     * @throws ApiErrorException
     */
    public function getFollowingStreamList(): array
    {
        $this->get('streams/followed', ['stream_type' => 'all']);

        $streamList = [];
        foreach ($this->getData()['streams'] AS $streamData) {
            $streamList[] = TwitchStream::createFromJson($streamData);
        }

        return $streamList;
    }


    // ################
    // # CHAT METHODS #
    // ################
    /**
     * Scope: -
     * @return mixed[]
     * @throws ApiErrorException
     */
    public function getBadgeList(int $channelId = 0): array
    {
        $channelId = $channelId > 0 ? $channelId : $this->getChannelId();
        $this->get('chat/' . $channelId . '/badges');

        return $this->getData();
    }

    /**
     * Scope: -
     * @return string
     * @throws ApiErrorException
     */
    public function getUserList(): string
    {
        $_tmpBaseUrl = $this->base_url;
        $this->base_url = 'https://tmi.twitch.tv/';
        $this->get('group/user/' . $this->getChannelName() . '/chatters', [], ['Cache-Control: no-cache']);
        $this->base_url = $_tmpBaseUrl;

        return $this->_raw_response;
    }

    /**
     * Scope: -
     * @return TwitchEmoticon[]
     * @throws ApiErrorException
     * @deprecated
     */
    public function getEmoticonList(): array
    {
        $this->get('chat/emoticons');

        $emoticonList = [];
        foreach ($this->getData()['emoticons'] AS $emoticonsData) {
            $emoticon = TwitchEmoticon::createFromJson($emoticonsData);
            $emoticonList[] = $emoticon;
        }

        return $emoticonList;
    }

    /**
     * Scope: -
     * @return TwitchEmoticonImage[]
     * @throws ApiErrorException
     */
    public function getEmoticonImageList(): array
    {
        $this->get('chat/emoticon_images');

        $emoticonList = [];
        foreach ($this->getData()['emoticons'] AS $emoticonsData) {
            $emoticon = TwitchEmoticonImage::createFromJson($emoticonsData);
            $emoticonList[] = $emoticon;
        }

        return $emoticonList;
    }

    /**
     * Scope: -
     * @param string $emoticonsets List of emoticonsets with , (comma) seperated
     * @return TwitchEmoticonImage[]
     * @throws ApiErrorException
     */
    public function getEmoticonImageListByEmoteiconSets(string $emoticonsets): array
    {
        $data = [];
        if (!empty($emoticonsets)) {
            $data['emotesets'] = $emoticonsets;
        }
        $this->get('chat/emoticon_images', $data);

        $emoticonList = [];
        foreach ($this->getData()['emoticon_sets'] AS $id => $emoticonsData) {
            foreach ($emoticonsData AS $data) {
                $emoticonList[] = TwitchEmoticonImage::createFromJson($data);

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
    public function getVideoById(int $videoId = 0): TwitchVideo
    {
        $videoId = $videoId > 0 ? $videoId : $this->getVideoId();
        $this->get('videos/' . $videoId);

        $data = $this->getData();
        $data['channel'] = $this->getChannel();

        return TwitchVideo::createFromJson($data);
    }
}