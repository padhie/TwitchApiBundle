<?php

namespace Padhie\tests\Helper;

use PHPUnit\Framework\TestCase;
use Padhie\TwitchApiBundle\Helper\TwitchApiModelHelper;

class TwitchApiModelHelperTest extends TestCase
{
    public function loadFixture(String $filename): array
    {
        $raw = file_get_contents(__DIR__ . '/../Fixtures/' . $filename . '.json');
        return json_decode($raw, true);
    }

    public function testFillChannelModelByJson(): void
    {
        $fixture = $this->loadFixture('channel');
        $channelModel = TwitchApiModelHelper::fillChannelModelByJson($fixture);

        self::assertEquals($channelModel->isMature(), $fixture['mature']);
        self::assertEquals($channelModel->getStatus(), $fixture['status']);
        self::assertEquals($channelModel->getBroadcasterLanguage(), $fixture['broadcaster_language']);
        self::assertEquals($channelModel->getDisplayName(), $fixture['display_name']);
        self::assertEquals($channelModel->getGame(), $fixture['game']);
        self::assertEquals($channelModel->getLanguage(), $fixture['language']);
        self::assertEquals($channelModel->getId(), $fixture['_id']);
        self::assertEquals($channelModel->getName(), $fixture['name']);
        self::assertEquals($channelModel->isPartner(), $fixture['partner']);
        self::assertEquals($channelModel->getLogo(), $fixture['logo']);
        self::assertEquals($channelModel->getVideoBanner(), $fixture['video_banner']);
        self::assertEquals($channelModel->getProfileBanner(), $fixture['profile_banner']);
        self::assertEquals($channelModel->getProfileBannerBackgroundColor(), $fixture['profile_banner_background_color']);
        self::assertEquals($channelModel->getUrl(), $fixture['url']);
        self::assertEquals($channelModel->getViews(), $fixture['views']);
        self::assertEquals($channelModel->getFollowers(), $fixture['followers']);

        // check return type
        $channelModel->getCreatedAt();
        $channelModel->getUpdatedAt();
    }

    public function testFillEmoticonModelByJson(): void
    {
        $fixture = $this->loadFixture('emoticon');
        $emoticonModel = TwitchApiModelHelper::fillEmoticonModelByJson($fixture);

        self::assertEquals($emoticonModel->getId(), $fixture['id']);
        self::assertEquals($emoticonModel->getRegex(), $fixture['regex']);
        self::assertIsArray($emoticonModel->getImages());
    }

    public function testFillEmoticonImageModelByJson(): void
    {
        $fixture = $this->loadFixture('emoticon');
        $fixtureImages = $fixture['images'][0];

        $imageModel = TwitchApiModelHelper::fillEmoticonImageModelByJson($fixtureImages);
        self::assertEquals($imageModel->getWidth(), $fixtureImages['width']);
        self::assertEquals($imageModel->getHeight(), $fixtureImages['height']);
        self::assertEquals($imageModel->getUrl(), $fixtureImages['url']);
        self::assertEquals($imageModel->getEmoticonSet(), $fixtureImages['emoticon_set']);
        self::assertNull($imageModel->getId());
        self::assertNull($imageModel->getCode());

        $fixtureImages = $fixture['images'][1];
        $imageModel = TwitchApiModelHelper::fillEmoticonImageModelByJson($fixtureImages);
        self::assertNull($imageModel->getWidth());
        self::assertNull($imageModel->getHeight());
        self::assertNull($imageModel->getUrl());
        self::assertEquals($imageModel->getEmoticonSet(), $fixtureImages['emoticon_set']);
        self::assertEquals($imageModel->getId(), $fixtureImages['id']);
        self::assertEquals($imageModel->getCode(), $fixtureImages['code']);
    }

    public function testFillFollowerModelByJson(): void
    {
        $fixture = $this->loadFixture('follow');
        $followModel = TwitchApiModelHelper::fillFollowerModelByJson($fixture);

        self::assertEquals($followModel->isNotifications(), $fixture['notifications']);
        self::assertNull($followModel->getChannel());

        // check return type
        $followModel->getCreatedAt();
        $followModel->getUser();
    }

    public function testFillUserModelByJson(): void
    {
        $fixture = $this->loadFixture('follow')['user'];
        $userModel = TwitchApiModelHelper::fillUserModelByJson($fixture);

        self::assertEquals($userModel->getDisplayName(), $fixture['display_name']);
        self::assertEquals($userModel->getId(), $fixture['_id']);
        self::assertEquals($userModel->getName(), $fixture['name']);
        self::assertEquals($userModel->getType(), $fixture['type']);
        self::assertEquals($userModel->getBio(), $fixture['bio']);
        self::assertEquals($userModel->getLogo(), $fixture['logo']);

        // check return type
        $userModel->getCreatedAt();
        $userModel->getUpdatedAt();
    }

    public function testFillSubscriptionModelByJson(): void
    {
        $fixture = $this->loadFixture('subscription');
        $subscriptionModel = TwitchApiModelHelper::fillSubscriptionModelByJson($fixture);

        self::assertEquals($subscriptionModel->getId(), $fixture['_id']);
        self::assertEquals($subscriptionModel->getSubPlan(), $fixture['sub_plan']);
        self::assertEquals($subscriptionModel->getSubPlanName(), $fixture['sub_plan_name']);
        self::assertNull($subscriptionModel->getChannel());

        // check return type
        $subscriptionModel->getCreatedAt();
        $subscriptionModel->getUser();
    }

    public function testFillVideoModelByJson(): void
    {
        $fixture = $this->loadFixture('video');
        $videoModel = TwitchApiModelHelper::fillVideoModelByJson($fixture);

        self::assertEquals($videoModel->getId(), $fixture['_id']);
        self::assertEquals($videoModel->getBroadcastId(), $fixture['broadcast_id']);
        self::assertEquals($videoModel->getBroadcastType(), $fixture['broadcast_type']);
        self::assertEquals($videoModel->getDescription(), $fixture['description']);
        self::assertEquals($videoModel->getDescriptionHtml(), $fixture['description_html']);
        self::assertEquals($videoModel->getFps(), $fixture['fps']);
        self::assertEquals($videoModel->getGame(), $fixture['game']);
        self::assertEquals($videoModel->getLanguage(), $fixture['language']);
        self::assertEquals($videoModel->getLength(), $fixture['length']);
        self::assertNotEmpty($videoModel->getMutedSegments());
        self::assertEquals($videoModel->getPreview(), $fixture['preview']);
        self::assertEquals($videoModel->getStatus(), $fixture['status']);
        self::assertEquals($videoModel->getTagList(), $fixture['tag_list']);
        self::assertNotEmpty($videoModel->getThumbnails());
        self::assertEquals($videoModel->getTitle(), $fixture['title']);
        self::assertEquals($videoModel->getUrl(), $fixture['url']);
        self::assertEquals($videoModel->getViewable(), $fixture['viewable']);
        self::assertEquals($videoModel->getViews(), $fixture['views']);

        // check return type
        $videoModel->getCreatedAt();
        $videoModel->getPublishedAt();
        $videoModel->getViewableAt();
        $videoModel->getChannel();
    }

    public function testFillVideoThumbnailsModelByJson(): void
    {
        $fixture = $this->loadFixture('video')['thumbnails']['large'];
        $thumbnailsModel = TwitchApiModelHelper::fillVideoThumbnailsModelByJson($fixture);

        self::assertEquals($thumbnailsModel[0]->getType(), $fixture[0]['type']);
        self::assertEquals($thumbnailsModel[0]->getUrl(), $fixture[0]['url']);
    }

    public function testFillVideoMutedSegmentsModelByJson(): void
    {
        $fixture = $this->loadFixture('video')['muted_segments'][0];
        $mutedSegmentModel = TwitchApiModelHelper::fillVideoMutedSegmentsModelByJson($fixture);

        self::assertEquals($mutedSegmentModel->getDuration(), $fixture['duration']);
        self::assertEquals($mutedSegmentModel->getOffset(), $fixture['offset']);
    }

    public function testFillStreamModelByJson(): void
    {
        $fixture = $this->loadFixture('stream');
        $streamModel = TwitchApiModelHelper::fillStreamModelByJson($fixture);

        self::assertEquals($streamModel->getId(), $fixture['_id']);
        self::assertEquals($streamModel->getGame(), $fixture['game']);
        self::assertEquals($streamModel->getViewers(), $fixture['viewers']);
        self::assertEquals($streamModel->getVideoHeight(), $fixture['video_height']);
        self::assertEquals($streamModel->getAverageFps(), $fixture['average_fps']);
        self::assertEquals($streamModel->getDelay(), $fixture['delay']);
        self::assertEquals($streamModel->isPlaylist(), $fixture['is_playlist']);
        self::assertEquals($streamModel->getPreview(), $fixture['preview']);

        // check return type
        $streamModel->getCreatedAt();
        $streamModel->getChannel();
    }

    public function testFillTeamModelByJson(): void
    {
        $fixture = $this->loadFixture('team');
        $teamModel = TwitchApiModelHelper::fillTeamModelByJson($fixture);
        self::assertEquals($teamModel->getId(), $fixture['_id']);
        self::assertEquals($teamModel->getBackground(), $fixture['background']);
        self::assertEquals($teamModel->getBanner(), $fixture['banner']);
        self::assertEquals($teamModel->getDisplayName(), $fixture['display_name']);
        self::assertEquals($teamModel->getInfo(), $fixture['info']);
        self::assertEquals($teamModel->getLogo(), $fixture['logo']);
        self::assertEquals($teamModel->getName(), $fixture['name']);

        // check return type
        $teamModel->getCreatedAt();
        $teamModel->getUpdatedAt();
    }

    public function testFillValidateModelByJson(): void
    {
        $validateFixture = $this->loadFixture('validate');
        $userFixture = $this->loadFixture('user');

        $userModel = TwitchApiModelHelper::fillUserModelByJson($userFixture);
        $validateModel = TwitchApiModelHelper::fillValidateModelByJson($validateFixture, $userModel);

        self::assertEquals($validateFixture['client_id'], $validateModel->getClientId());
        self::assertEquals($validateFixture['login'], $validateModel->getLogin());
        self::assertEquals($validateFixture['scopes'], $validateModel->getScopes());
        self::assertEquals($validateFixture['user_id'], $validateModel->getUserId());
        self::assertEquals($userModel, $validateModel->getUser());
    }

    public function testFillChannelSubscriptionsModelByJson(): void
    {
        $channelSubscriptionsFixture = $this->loadFixture('channel_subscriptions');

        $channelSubscriptions = $this->modelHelper->fillChannelSubscriptionsModelByJson($channelSubscriptionsFixture);

        self::assertSame(4, $channelSubscriptions->getTotal());
        self::assertCount(1, $channelSubscriptions->getSubscriptions());
    }
}
