<?php

namespace TwitchApiBundle\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use TwitchApiBundle\Exception\ApiErrorException;
use TwitchApiBundle\Exception\UserNotExistsException;
use TwitchApiBundle\Helper\TwitchApiModelHelper;
use TwitchApiBundle\Model\TwitchChannel;
use TwitchApiBundle\Model\TwitchEmoticon;
use TwitchApiBundle\Model\TwitchEmoticonImage;
use TwitchApiBundle\Model\TwitchFollower;
use TwitchApiBundle\Model\TwitchHost;
use TwitchApiBundle\Model\TwitchStream;
use TwitchApiBundle\Model\TwitchTeam;
use TwitchApiBundle\Model\TwitchUser;
use TwitchApiBundle\Model\TwitchValidate;
use TwitchApiBundle\Model\TwitchVideo;

class TwitchApiService
{
    /**
     * @var array
     */
    public const SCOPE_USER = [
        'user_read',
        'user_follows_edit',
    ];

    /**
     * @var array
     */
    public const SCOPE_CHANNEL = [
        'channel_read',
        'channel_stream',
        'channel_editor',
        'channel_subscriptions',
        'channel_check_subscription',
        'channel_commercial',
    ];

    /**
     * @var int
     */
    private const REQUEST_READ_LIMIT = 8192;

    /**
     * @var Client
     */
    private $guzzle;

    /**
     * @var string
     */
    private $client_id;

    /**
     * @var string
     */
    private $client_secret;

    /**
     * @var string
     */
    private $redirect_url;

    /**
     * @var string
     */
    private $base_url = "https://api.twitch.tv/kraken/";

    /**
     * @var string
     */
    private $header_application = 'application/vnd.twitchtv.v5+json';

    /**
     * @var string
     */
    private $oauth;

    /**
     * @var string
     */
    private $additional_string;

    /**
     * @var string
     */
    private $_raw_response;

    /**
     * @var array
     */
    private $response;

    /**
     * @var integer
     */
    private $channel_id;

    /**
     * @var string
     */
    private $channel_name;

    /**
     * @var integer
     */
    private $user_id;

    /**
     * @var integer
     */
    private $video_id;

    /**
     * @var string
     */
    private $last_url;


    /**
     * TwitchApiService constructor.
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param string $redirectUrl
     */
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
    /**
     * @param string $oauth
     *
     * @return $this
     */
    public function setOAuth(string $oauth): self
    {
        $this->oauth = $oauth;

        return $this;
    }

    /**
     * @param string $additional
     *
     * @return $this
     */
    public function setAdditionalString(string $additional): self
    {
        $this->additional_string = $additional;

        return $this;
    }

    /**
     * @param array $scopeList
     *
     * @return string
     */
    public function getAccessTokenUrl(array $scopeList = []): string
    {
        $scope = implode('+', $scopeList);

        $sUrl = $this->base_url . "oauth2/authorize?";
        $sParams = "response_type=token" .
            "&client_id=" . $this->client_id .
            "&scope=" . $scope .
            "&redirect_uri=" . $this->redirect_url;

        return $sUrl . $sParams;
    }

    /**
     * @param int $channelId
     *
     * @return TwitchApiService
     */
    public function setChannelId(int $channelId): self
    {
        $this->channel_id = $channelId;

        return $this;
    }

    /**
     * @return int
     */
    public function getChannelId(): int
    {
        return $this->channel_id;
    }

    /**
     * @param string $channelName
     *
     * @return TwitchApiService
     */
    public function setChannelName(string $channelName): self
    {
        $this->channel_name = $channelName;

        return $this;
    }

    /**
     * @return string
     */
    public function getChannelName(): string
    {
        return $this->channel_name;
    }

    /**
     * @param int $userId
     *
     * @return $this
     */
    public function setUserId(int $userId): self
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $videoId
     *
     * @return $this
     */
    public function setVideoId(int $videoId): self
    {
        $this->video_id = $videoId;

        return $this;
    }

    /**
     * @return int
     */
    public function getVideoId(): int
    {
        return $this->video_id;
    }

    /**
     * @return array
     */
    protected function getData(): array
    {
        return $this->response;
    }

    /**
     * @param string[] $header [optional]
     *
     * @return string[]
     */
    private function combineHeader(array $header = []): array
    {
        return array_merge($header, [
            'Accept'        => $this->header_application,
            'Client-ID'     => $this->client_id,
            'Authorization' => 'OAuth ' . $this->oauth,
            'Cache-Control' => 'no-cache',
        ]);
    }


    // ################
    // # BASE METHODS #
    // ################
    /**
     * @param string $url_extension URL endpoint
     * @param array  $data          [optional] Key => Value
     * @param array  $header        [optional] Key => Value
     *
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
     * @param string $url_extension URL endpoint
     * @param array  $data          [optional] Key => Value
     * @param array  $header        [optional] Key => Value
     *
     * @return TwitchApiService
     * @throws ApiErrorException
     */
    protected function put($url_extension, $data = [], $header = []): self
    {
        $options = array_merge($this->combineHeader($header), ['body' => $data]);
        $this->last_url = $this->base_url . $url_extension . $this->additional_string;

        try {
            $request = new Request('PUT', $this->last_url, $options);
            $response = $this->guzzle->send($request);

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
        while($check) {
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

        $user = $this->getUserByName($this->getData()['login']);

        return TwitchApiModelHelper::fillValidateModelByJson($this->getData(), $user);


    }

    // ################
    // # USER METHODS #
    // ################
    /**
     * Scope: user_read
     *
     * @param string $name
     *
     * @return TwitchUser
     * @throws ApiErrorException
     * @throws UserNotExistsException
     */
    public function getUserByName($name): TwitchUser
    {
        $this->get('users?login=' . $name);

        if (!isset($this->getData()['users'][0])) {
            throw new UserNotExistsException('No userdata exists', 1530903951);
        }

        return TwitchApiModelHelper::fillUserModelByJson($this->getData()['users'][0]);
    }

    /**
     * Scope: user_read
     * @return TwitchUser
     * @throws ApiErrorException
     */
    public function getUser(): TwitchUser
    {
        $this->get('user');

        return TwitchApiModelHelper::fillUserModelByJson($this->getData());
    }

    /**
     * Scope: -
     * @return TwitchUser
     * @throws ApiErrorException
     */
    public function getUserById(): TwitchUser
    {
        $this->get('users/' . $this->getUserId());

        return TwitchApiModelHelper::fillUserModelByJson($this->getData());
    }

    /**
     * Scope: user_subscriptions
     * @return bool
     */
    public function isUserSubscribingChannel(): bool
    {
        try {
            $this->get('users/' . $this->getUserId() . '/subscriptions/' . $this->getChannelId());
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
     * @return TwitchFollower
     */
    public function getUserFollowingChannel(): TwitchFollower
    {
        $this->isUserFollowingChannel();
        $data = $this->getData();
        $data['user'] = $this->getUser();

        return TwitchApiModelHelper::fillFollowerModelByJson($data);
    }

    /**
     * Scope: -
     * @return bool
     */
    public function isUserFollowingChannel(): bool
    {
        try {
            $this->get('users/' . $this->getUserId() . '/follows/channels/' . $this->getChannelId());
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
    public function getChannelFollower(): array
    {
        $this->get('users/' . $this->getUserId() . '/follows/channels');

        $followerList = [];
        foreach ($this->getData()['follows'] AS $followerData) {
            $followerList[] = TwitchApiModelHelper::fillFollowerModelByJson($followerData);
        }

        return $followerList;
    }

    /**
     * Scope: user_follows_edit
     * @return TwitchChannel
     * @throws ApiErrorException
     */
    public function setUserFollowingChannel(): TwitchChannel
    {
        $this->put('users/' . $this->getUserId() . '/follows/channels/' . $this->getChannelId());

        return TwitchApiModelHelper::fillChannelModelByJson($this->getData());
    }


    // ###################
    // # CHANNEL METHODS #
    // ###################
    /**
     * Scope: channel_read
     * @return TwitchChannel
     * @throws ApiErrorException
     */
    public function getChannel(): TwitchChannel
    {
        $this->get("channel");

        return TwitchApiModelHelper::fillChannelModelByJson($this->getData());
    }

    /**
     * Scope: -
     * @return TwitchChannel
     * @throws ApiErrorException
     */
    public function getChannelById(): TwitchChannel
    {
        $this->get("channels/" . $this->getChannelId());

        return TwitchApiModelHelper::fillChannelModelByJson($this->getData());
    }

    /**
     * Scope: -
     * @return TwitchFollower[]
     * @throws ApiErrorException
     */
    public function getFollowerList(): array
    {
        $this->get('channels/' . $this->getChannelId() . '/follows');

        $followerList = [];
        foreach ($this->getData()['follows'] AS $followerData) {
            $followerList[] = TwitchApiModelHelper::fillFollowerModelByJson($followerData);
        }

        return $followerList;
    }

    /**
     * Scope: -
     * @return TwitchTeam[]
     * @throws ApiErrorException
     */
    public function getTeamList(): array
    {
        $this->get('channels/' . $this->getChannelId() . '/team');

        $teamList = [];
        foreach ($this->getData()['follows'] AS $teamData) {
            $teamList[] = TwitchApiModelHelper::fillTeamModelByJson($teamData);
        }

        return $teamList;
    }

    /**
     * Scope: channel_editor
     *
     * @param string $title
     *
     * @return TwitchChannel
     * @throws ApiErrorException
     */
    public function changeChannelTitle($title): TwitchChannel
    {
        $data = [
            'channel[status]' => $title,
        ];
        $this->put('channels/' . $this->getChannelId(), $data);

        return TwitchApiModelHelper::fillChannelModelByJson($this->getData());
    }

    /**
     * Scope: channel_editor
     *
     * @param string $game
     *
     * @return TwitchChannel
     * @throws ApiErrorException
     */
    public function changeChannelGame($game): TwitchChannel
    {
        $data = [
            'channel[game]' => $game,
        ];
        $this->put('channels/' . $this->getChannelId(), $data);

        return TwitchApiModelHelper::fillChannelModelByJson($this->getData());
    }

    /**
     * Data get out from API
     * Scope: -
     * @return TwitchHost[]
     * @throws ApiErrorException
     */
    public function getHosts(): array
    {
        $_tmpBaseUrl = $this->base_url;
        $this->base_url = 'https://tmi.twitch.tv/';
        $this->get("hosts?include_logins=1&target=" . $this->getChannelId(), [], ['Cache-Control: no-cache']);
        $this->base_url = $_tmpBaseUrl;

        $origChannelId = $this->getChannelId();
        $data = $this->getData();
        $hostList = [];
        foreach ($data["hosts"] AS $host) {
            $twitchHost = new TwitchHost();

            $this->setChannelId($host['host_id']);
            $twitchHost->setChannel($this->getChannelById());

            $this->setChannelId($host['target_id']);
            $twitchHost->setTarget($this->getChannelById());

            if (isset($host['host_recent_chat_activity_count'])) {
                $twitchHost->setViewer($host['host_recent_chat_activity_count']);
            }

            $hostList[] = $twitchHost;
        }
        $this->setChannelId($origChannelId);

        return $hostList;
    }


    // ##################
    // # STREAM METHODS #
    // ##################
    /**
     * Scope: -
     * @return TwitchStream|null Return TwitchStream if data return else NULL
     * @throws ApiErrorException
     */
    public function getStream(): ?TwitchStream
    {
        $this->get('streams/' . $this->getChannelId());
        $returnData = $this->getData();

        if ($returnData['stream']) {
            return TwitchApiModelHelper::fillStreamModelByJson($returnData['stream']);
        }

        return null;
    }

    /**
     * Scope: user_read
     * Return a list of all online and playlist streams
     * @return TwitchStream[]
     * @throws ApiErrorException
     */
    public function getFollowingStreamList(): array
    {
        $this->get('streams/followed', ['stream_type' => 'all']);

        $streamList = [];
        foreach ($this->getData()['streams'] AS $streamData) {
            $streamList[] = TwitchApiModelHelper::fillStreamModelByJson($streamData);
        }

        return $streamList;
    }


    // ################
    // # CHAT METHODS #
    // ################
    /**
     * Scope: -
     * @return array
     * @throws ApiErrorException
     */
    public function getBadgeList(): array
    {
        $this->get('chat/' . $this->getChannelId() . '/badges');

        return $this->getData();
    }

    /**
     * Data get out from API
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
     * @deprecated
     * @return TwitchEmoticon[]
     * @throws ApiErrorException
     */
    public function getEmoticonList(): array
    {
        $this->get('chat/emoticons');

        $emoticonList = [];
        foreach ($this->getData()['emoticons'] AS $emoticonsData) {
            $emoticon = TwitchApiModelHelper::fillEmoticonModelByJson($emoticonsData);
            $emoticonList[] = $emoticon;
        }

        return $emoticonList;
    }

    /**
     * Scope: -
     *
     * @return TwitchEmoticonImage[]
     * @throws ApiErrorException
     */
    public function getEmoticonImageList(): array
    {
        $data = [];
        if (!empty($emoticonset)) {
            $data['emotesets'] = $emoticonset;
        }
        $this->get('chat/emoticon_images', $data);

        $emoticonList = [];
        foreach ($this->getData()['emoticons'] AS $emoticonsData) {
            $emoticon = TwitchApiModelHelper::fillEmoticonImageModelByJson($emoticonsData);
            $emoticonList[] = $emoticon;
        }

        return $emoticonList;
    }

    /**
     * Scope: -
     *
     * @param string $emoticonsets List of emoticonsets with , (comma) seperated
     *
     * @return TwitchEmoticonImage[]
     * @throws ApiErrorException
     */
    public function getEmoticonImageListByEmoteiconSets($emoticonsets): array
    {
        $data = [];
        if (!empty($emoticonsets)) {
            $data['emotesets'] = $emoticonsets;
        }
        $this->get('chat/emoticon_images', $data);

        $emoticonList = [];
        foreach ($this->getData()['emoticon_sets'] AS $id => $emoticonsData) {
            foreach ($emoticonsData AS $data) {
                $emoticon = TwitchApiModelHelper::fillEmoticonImageModelByJson($data);
                $emoticon->setEmoticonSet($id);
                $emoticonList[] = $emoticon;

            }
        }

        return $emoticonList;
    }


    // #################
    // # VIDEO METHODS #
    // #################
    /**
     * Scope: -
     * @return TwitchVideo
     * @throws ApiErrorException
     */
    public function getVideoById(): TwitchVideo
    {
        $this->get('videos/' . $this->getVideoId());

        return TwitchApiModelHelper::fillVideoModelByJson($this->getData());
    }
}