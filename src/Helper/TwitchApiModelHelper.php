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
use TwitchApiBundle\Model\TwitchUserNotifications;
use TwitchApiBundle\Model\TwitchVideo;
use TwitchApiBundle\Model\TwitchVideoMutedSegments;
use TwitchApiBundle\Model\TwitchVideoThumbnail;

class TwitchApiModelHelper
{
    public static function convertToArray(TwitchModel $model): array
    {
        $modelData = (array)$model;
        $returnValue = [];
        /** @var mixed $value */
        foreach ($modelData AS $key => $value) {
            $newKey = substr($key, strrpos($key, "\x00") + 1);

            if ($value instanceof TwitchModel) {
                $value = self::convertToArray($value);
            } elseif ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $returnValue[$newKey] = $value;

        }

        return $returnValue;
    }

    public static function fillChannelModelByJson(array $json, ?TwitchChannel $channel = null): TwitchChannel
    {
        if (!($channel instanceof TwitchChannel)) {
            $channel = new TwitchChannel();
        }

        $channel->setId($json['_id']);
        $channel->setName($json['name']);
        $channel->setDisplayName($json['display_name']);

        if (isset($json['mature'])) {
            $channel->setMature($json['mature']);
        }
        if (isset($json['status'])) {
            $channel->setStatus($json['status']);
        }
        if (isset($json['broadcaster_language'])) {
            $channel->setBroadcasterLanguage($json['broadcaster_language']);
        }
        if (isset($json['game'])) {
            $channel->setGame($json['game']);
        }
        if (isset($json['language'])) {
            $channel->setLanguage($json['language']);
        }
        if (isset($json['created_at'])) {
            $channel->setCreatedAt(new \DateTime($json['created_at']));
        }
        if (isset($json['updated_at'])) {
            $channel->setUpdatedAt(new \DateTime($json['updated_at']));
        }
        if (isset($json['partner'])) {
            $channel->setPartner($json['partner']);
        }
        if (isset($json['logo'])) {
            $channel->setLogo($json['logo']);
        }
        if (isset($json['video_banner'])) {
            $channel->setVideoBanner($json['video_banner']);
        }
        if (isset($json['profile_banner'])) {
            $channel->setProfileBanner($json['profile_banner']);
        }
        if (isset($json['profile_banner_background_color'])) {
            $channel->setProfileBannerBackgroundColor($json['profile_banner_background_color']);
        }
        if (isset($json['url'])) {
            $channel->setUrl($json['url']);
        }
        if (isset($json['views'])) {
            $channel->setViews($json['views']);
        }
        if (isset($json['followers'])) {
            $channel->setFollowers($json['followers']);
        }

        return $channel;
    }

    public static function fillEmoticonModelByJson(array $json, ?TwitchEmoticon $emoticon = null): TwitchEmoticon
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

    public static function fillEmoticonImageModelByJson(array $json, ?TwitchEmoticonImage $image = null): TwitchEmoticonImage
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

    public static function fillFollowerModelByJson(array $json, ?TwitchFollower $follower = null): TwitchFollower
    {
        if (!($follower instanceof TwitchFollower)) {
            $follower = new TwitchFollower();
        }

        $follower->setCreatedAt(new \DateTime($json['created_at']));
        $follower->setNotifications($json['notifications']);

        if (isset($json['user'])) {
            if ($json['user'] instanceof TwitchUser) {
                $follower->setUser($json['user']);
            } else {
                $follower->setUser(self::fillUserModelByJson($json['user']));
            }
        }

        if (isset($json['channel'])) {
            if ($json['channel'] instanceof TwitchChannel) {
                $follower->setChannel($json['channel']);
            } else {
                $follower->setChannel(self::fillChannelModelByJson($json['channel']));
            }
        }

        return $follower;
    }

    public static function fillUserModelByJson(array $json, ?TwitchUser $user = null): TwitchUser
    {
        if (!($user instanceof TwitchUser)) {
            $user = new TwitchUser();
        }

        $user->setDisplayName($json['display_name']);
        $user->setId($json['_id']);
        $user->setName($json['name']);
        $user->setType($json['type']);
        $user->setCreatedAt(new \DateTime($json['created_at']));
        $user->setUpdatedAt(new \DateTime($json['updated_at']));

        if (isset($json['bio'])) {
            $user->setBio($json['bio']);
        }

        if (isset($json['logo'])) {
            $user->setLogo($json['logo']);
        }

        if (isset($json['notifications'])) {
            $userNotifications = new TwitchUserNotifications();
            $userNotifications->setEmail($json['notifications']['email'])->setPush($json['notifications']['push']);
            $user->setNotifications($userNotifications);
        }


        return $user;
    }

    public static function fillSubscriptionModelByJson(array $json, ?TwitchSubscription $subscription = null): TwitchSubscription
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

    public static function fillVideoModelByJson(array $json, ?TwitchVideo $video = null): TwitchVideo
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
        $video->setPreview($json['preview']);
        $video->setPublishedAt(new \DateTime($json['published_at']));
        $video->setStatus($json['status']);
        $video->setTagList($json['tag_list']);
        $video->setTitle($json['title']);
        $video->setUrl($json['url']);
        $video->setViewable($json['viewable']);
        $video->setViewableAt(new \DateTime($json['viewable_at']));
        $video->setViews($json['views']);
        $video->setChannel(self::fillChannelModelByJson($json['channel']));

        if (isset($json['thumbnails'])) {
            /** @var array $thumbnail */
            foreach ($json['thumbnails'] AS $type => $thumbnail) {
                $video->addThumbnails($type, self::fillVideoThumbnailsModelByJson($thumbnail));
            }
        }

        if (isset($json['muted_segments'])) {
            foreach ($json['muted_segments'] AS $muted_segment) {
                $video->addMutedSegment(self::fillVideoMutedSegmentsModelByJson($muted_segment));
            }
        }

        return $video;
    }

    /**
     * @param array                       $json
     * @param TwitchVideoThumbnail[]|null $thumbnails
     *
     * @return TwitchVideoThumbnail[]
     */
    public static function fillVideoThumbnailsModelByJson(array $json, ?array $thumbnails = []): array
    {
        $thumbnails = $thumbnails ?? [];
        foreach ($json AS $thumbnailJson) {
            $thumbnail = new TwitchVideoThumbnail();
            $thumbnail->setType($thumbnailJson['type']);
            $thumbnail->setUrl($thumbnailJson['url']);

            $thumbnails[] = $thumbnail;
        }

        return $thumbnails;
    }

    public static function fillVideoMutedSegmentsModelByJson(array $json, ?TwitchVideoMutedSegments $mutedSegments = null): TwitchVideoMutedSegments
    {
        if (!($mutedSegments instanceof TwitchVideoMutedSegments)) {
            $mutedSegments = new TwitchVideoMutedSegments();
        }

        $mutedSegments->setDuration($json['duration']);
        $mutedSegments->setOffset($json['offset']);

        return $mutedSegments;
    }

    public static function fillStreamModelByJson(array $json, ?TwitchStream $stream = null): TwitchStream
    {
        if (!($stream instanceof TwitchStream)) {
            $stream = new TwitchStream();
        }

        $stream->setId($json['_id']);
        $stream->setGame($json['game']);
        $stream->setViewers($json['viewers']);
        $stream->setVideoHeight($json['video_height']);
        $stream->setAverageFps($json['average_fps']);
        $stream->setDelay($json['delay']);
        $stream->setCreatedAt(new \DateTime($json['created_at']));
        $stream->setIsPlaylist($json['is_playlist']);
        $stream->setPreview($json['preview']);
        $stream->setChannel(self::fillChannelModelByJson($json['channel']));

        return $stream;
    }

    public static function fillTeamModelByJson(array $json, ?TwitchTeam $team = null): TwitchTeam
    {
        if (!($team instanceof TwitchTeam)) {
            $team = new TwitchTeam();
        }

        $team->setId($json['_id']);
        $team->setBanner($json['banner']);
        $team->setCreatedAt(new \DateTime($json['created_at']));
        $team->setDisplayName($json['display_name']);
        $team->setInfo($json['info']);
        $team->setLogo($json['logo']);
        $team->setName($json['name']);
        $team->setUpdatedAt(new \DateTime($json['updated_at']));

        if (isset($json['background'])) {
            $team->setBackground($json['background']);
        }

        return $team;
    }
}