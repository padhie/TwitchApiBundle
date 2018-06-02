<?php

namespace TwitchApiBundle\Helper;

use TwitchApiBundle\Model\TwitchChannel;
use TwitchApiBundle\Model\TwitchEmoticon;
use TwitchApiBundle\Model\TwitchEmoticonImage;
use TwitchApiBundle\Model\TwitchFollower;
use TwitchApiBundle\Model\TwitchModel;
use TwitchApiBundle\Model\TwitchStream;
use TwitchApiBundle\Model\TwitchSubscription;
use TwitchApiBundle\Model\TwitchTeam;
use TwitchApiBundle\Model\TwitchUser;
use TwitchApiBundle\Model\TwitchVideo;

class TwitchApiModelHelper
{
    /**
     * @param TwitchModel $model
     *
     * @return array
     */
    public static function convertToArray(TwitchModel $model): array
    {
        $modelData = (array) $model;
        $returnValue = [];
        foreach ($modelData AS $key => $value) {
            $newKey = substr($key, strrpos($key, "\x00")+1);
            $returnValue[$newKey] = $value;
        }

        return $returnValue;
    }

    /**
     * @param                    $json
     * @param TwitchChannel|null $channel [optional]
     *
     * @return TwitchChannel
     */
    public static function fillChannelModelByJson($json, TwitchChannel $channel = null): TwitchChannel
    {
        if (!($channel instanceof TwitchChannel)) {
            $channel = new TwitchChannel();
        }

        $channel->setMature($json['mature']);
        $channel->setStatus($json['status']);
        $channel->setBroadcasterLanguage($json['broadcaster_language']);
        $channel->setDisplayName($json['display_name']);
        $channel->setGame($json['game']);
        $channel->setLanguage($json['language']);
        $channel->setId($json['_id']);
        $channel->setName($json['name']);
        $channel->setCreatedAt(new \DateTime($json['created_at']));
        $channel->setUpdatedAt(new \DateTime($json['updated_at']));
        $channel->setPartner($json['partner']);
        $channel->setLogo($json['logo']);
        $channel->setVideoBanner($json['video_banner']);
        $channel->setProfileBanner($json['profile_banner']);
        $channel->setProfileBannerBackgroundColor($json['profile_banner_background_color']);
        $channel->setUrl($json['url']);
        $channel->setViews($json['views']);
        $channel->setFollowers($json['followers']);

        return $channel;
    }

    /**
     * @param array               $json
     * @param TwitchEmoticon|null $emoticon [optional]
     *
     * @return TwitchEmoticon
     */
    public static function fillEmoticonModelByJson(array $json, TwitchEmoticon $emoticon = null): TwitchEmoticon
    {
        if (!($emoticon instanceof TwitchEmoticon)) {
            $emoticon = new TwitchEmoticon();
        }

        $emoticon->setId($json['id']);
        $emoticon->setRegex($json['regex']);

        foreach ($json['images'] AS $imageData) {
            $emoticon->addImage(self::fillEmoticonImageModelByJson($imageData));
        }

        return $emoticon;
    }

    /**
     * @param array                    $json
     * @param TwitchEmoticonImage|null $image [optional]
     *
     * @return TwitchEmoticonImage
     */
    public static function fillEmoticonImageModelByJson(array $json, TwitchEmoticonImage $image = null): TwitchEmoticonImage
    {
        if (!($image instanceof TwitchEmoticonImage)) {
            $image = new TwitchEmoticonImage();
        }

        $image->setWidth($json['width']);
        $image->setHeight($json['height']);
        $image->setUrl($json['url']);
        $image->setEmoticonSet($json['emoticon_set']);

        return $image;
    }

    /**
     * @param array               $json
     * @param TwitchFollower|null $follower [optional]
     *
     * @return TwitchFollower
     */
    public static function fillFollowerModelByJson(array $json, TwitchFollower $follower = null): TwitchFollower
    {
        if (!($follower instanceof TwitchFollower)) {
            $follower = new TwitchFollower();
        }

        $follower->setCreatedAt(new \DateTime($json['created_at']));
        $follower->setNotifications($json['notifications']);

        if (isset($json['user'])) {
            $follower->setUser(self::fillUserModelByJson($json['user']));
        }

        if (isset($json['channel'])) {
            $follower->setChannel(self::fillChannelModelByJson($json['channel']));
        }

        return $follower;
    }

    /**
     * @param array           $json
     * @param TwitchUser|null $user [optional]
     *
     * @return TwitchUser
     */
    public static function fillUserModelByJson(array $json, TwitchUser $user = null): TwitchUser
    {
        if (!($user instanceof TwitchUser)) {
            $user = new TwitchUser();
        }

        $user->setDisplayName($json['display_name']);
        $user->setId($json['_id']);
        $user->setName($json['name']);
        $user->setType($json['type']);
        $user->setBio($json['bio']);
        $user->setCreatedAt(new \DateTime($json['created_at']));
        $user->setUpdatedAt(new \DateTime($json['updated_at']));
        $user->setLogo($json['logo']);

        return $user;
    }

    /**
     * @param array                   $json
     * @param TwitchSubscription|null $subscription [optional]
     *
     * @return TwitchSubscription
     */
    public static function fillSubscriptionModelByJson(array $json, TwitchSubscription $subscription = null): TwitchSubscription
    {
        if (!($subscription instanceof TwitchSubscription)) {
            $subscription = new TwitchSubscription();
        }

        $subscription->setId($json['_id']);
        $subscription->setCreatedAt(new \DateTime($json['created_at']));
        $subscription->setSubPlan($json['sub_plan']);
        $subscription->setSubPlanName($json['sub_plan_name']);

        if (isset($json['user'])) {
            $subscription->setUser(self::fillUserModelByJson($json['user']));
        }

        if (isset($json['channel'])) {
            $subscription->setChannel(self::fillChannelModelByJson($json['channel']));
        }

        return $subscription;
    }

    /**
     * @param array            $json
     * @param TwitchVideo|null $video [optional]
     *
     * @return TwitchVideo
     */
    public static function fillVideoModelByJson(array $json, TwitchVideo $video = null): TwitchVideo
    {
        if (!($video instanceof TwitchVideo)) {
            $video = new TwitchVideo();
        }

        $video->setId($json['_id']);
        $video->setBroadcastId($json['broadcast_id']);
        $video->setBroadcastType($json['broadcast_type']);
        $video->setCreatedAt(new \DateTime($json['created_at']));
        $video->setDescription($json['description']);
        $video->setDescriptionHtml($json['description_html']);
        $video->setFps($json['fps']);
        $video->setGame($json['game']);
        $video->setLanguage($json['language']);
        $video->setLength($json['length']);
        $video->setMutedSegments($json['muted_segments']);
        $video->setPreview($json['preview']);
        $video->setPublishedAt(new \DateTime($json['published_at']));
        $video->setStatus($json['status']);
        $video->setTagList($json['tag_list']);
        $video->setThubnails($json['thumbnails']);
        $video->setTitle($json['title']);
        $video->setUrl($json['url']);
        $video->setViewable($json['viewable']);
        $video->setViewableAt(new \DateTime($json['viewable_at']));
        $video->setViews($json['views']);
        $video->setChannel(self::fillChannelModelByJson($json['channel']));

        return $video;
    }

    /**
     * @param array             $json
     * @param TwitchStream|null $stream [optional]
     *
     * @return TwitchStream
     */
    public static function fillStreamModelByJson(array $json, TwitchStream $stream = null): TwitchStream
    {
        if (!($stream instanceof TwitchStream)) {
            $stream = new TwitchStream();
        }

        $stream->setId($json['_id']);
        $stream->setGame($json['game']);
        $stream->setVideoHeight($json['viewers']);
        $stream->setVideoHeight($json['video_height']);
        $stream->setAverageFps($json['average_fps']);
        $stream->setDelay($json['delay']);
        $stream->setCreatedAt(new \DateTime($json['created_at']));
        $stream->setIsPlaylist($json['is_playlist']);
        $stream->setPreview($json['preview']);
        $stream->setChannel(self::fillChannelModelByJson($json['channel']));

        return $stream;
    }

    /**
     * @param array           $json
     * @param TwitchTeam|null $team [optional]
     *
     * @return TwitchTeam
     */
    public static function fillTeamModelByJson(array $json, TwitchTeam $team = null): TwitchTeam
    {
        if (!($team instanceof TwitchTeam)) {
            $team = new TwitchTeam();
        }

        $team->setId($json['_id']);
        $team->setBackground($json['background']);
        $team->setBanner($json['banner']);
        $team->setCreatedAt(new \DateTime($json['created_at']));
        $team->setDisplayName($json['display_name']);
        $team->setInfo($json['info']);
        $team->setLogo($json['logo']);
        $team->setName($json['name']);
        $team->setUpdatedAt(new \DateTime($json['updated_at']));

        return $team;
    }
}