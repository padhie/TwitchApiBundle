<?php

namespace tests\Helper;

use PHPUnit\Framework\TestCase;
use \TwitchApiBundle\Helper\TwitchApiModelHelper;
use \TwitchApiBundle\Model\TwitchUser;
use \TwitchApiBundle\Model\TwitchChannel;

class TwitchApiModelHelperTest extends TestCase
{
    /** @var TwitchApiModelHelper */
    private $modelHelper;

    public function setUp(): void
    {
        $this->modelHelper = new TwitchApiModelHelper();
    }

    public function loadFixture(String $filename): array
    {
        $raw = file_get_contents(__DIR__ . '/../Fixtures/' . $filename . '.json');
        return json_decode($raw, true);
    }

    public function testFillChannelModelByJson(): void
    {
        $fixture = $this->loadFixture('channel');
        $channelModel = $this->modelHelper->fillChannelModelByJson($fixture);

        self::assertEquals($channelModel->isMature(), $fixture['mature']);
        self::assertEquals($channelModel->getStatus(), $fixture['status']);
        self::assertEquals($channelModel->getBroadcasterLanguage(), $fixture['broadcaster_language']);
        self::assertEquals($channelModel->getDisplayName(), $fixture['display_name']);
        self::assertEquals($channelModel->getGame(), $fixture['game']);
        self::assertEquals($channelModel->getLanguage(), $fixture['language']);
        self::assertEquals($channelModel->getId(), $fixture['_id']);
        self::assertEquals($channelModel->getName(), $fixture['name']);
        self::assertTrue($channelModel->getCreatedAt() instanceof \DateTime);
        self::assertTrue($channelModel->getUpdatedAt() instanceof \DateTime);
        self::assertEquals($channelModel->isPartner(), $fixture['partner']);
        self::assertEquals($channelModel->getLogo(), $fixture['logo']);
        self::assertEquals($channelModel->getVideoBanner(), $fixture['video_banner']);
        self::assertEquals($channelModel->getProfileBanner(), $fixture['profile_banner']);
        self::assertEquals($channelModel->getProfileBannerBackgroundColor(), $fixture['profile_banner_background_color']);
        self::assertEquals($channelModel->getUrl(), $fixture['url']);
        self::assertEquals($channelModel->getViews(), $fixture['views']);
        self::assertEquals($channelModel->getFollowers(), $fixture['followers']);
    }

    public function testFillEmoticonModelByJson(): void
    {
        $fixture = $this->loadFixture('emoticon');
        $emoticonModel = $this->modelHelper->fillEmoticonModelByJson($fixture);

        self::assertEquals($emoticonModel->getId(), $fixture['id']);
        self::assertEquals($emoticonModel->getRegex(), $fixture['regex']);
        self::assertInternalType('array', $emoticonModel->getImages());
    }

    public function testFillEmoticonImageModelByJson(): void
    {
        $fixture = $this->loadFixture('emoticon');
        $fixtureImages = $fixture['images'][0];

        $imageModel = $this->modelHelper->fillEmoticonImageModelByJson($fixtureImages);
        self::assertEquals($imageModel->getWidth(), $fixtureImages['width']);
        self::assertEquals($imageModel->getHeight(), $fixtureImages['height']);
        self::assertEquals($imageModel->getUrl(), $fixtureImages['url']);
        self::assertEquals($imageModel->getEmoticonSet(), $fixtureImages['emoticon_set']);
        self::assertNull($imageModel->getId());
        self::assertNull($imageModel->getCode());

        $fixtureImages = $fixture['images'][1];
        $imageModel = $this->modelHelper->fillEmoticonImageModelByJson($fixtureImages);
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
        $followModel = $this->modelHelper->fillFollowerModelByJson($fixture);

        self::assertTrue($followModel->getCreatedAt() instanceof \DateTime);
        self::assertEquals($followModel->isNotifications(), $fixture['notifications']);
        self::assertTrue($followModel->getUser() instanceof TwitchUser);
        self::assertNull($followModel->getChannel());
    }

    public function testFillUserModelByJson(): void
    {
        $fixture = $this->loadFixture('follow')['user'];
        $userModel = $this->modelHelper->fillUserModelByJson($fixture);

        self::assertEquals($userModel->getDisplayName(), $fixture['display_name']);
        self::assertEquals($userModel->getId(), $fixture['_id']);
        self::assertEquals($userModel->getName(), $fixture['name']);
        self::assertEquals($userModel->getType(), $fixture['type']);
        self::assertEquals($userModel->getBio(), $fixture['bio']);
        self::assertTrue($userModel->getCreatedAt() instanceof \DateTime);
        self::assertTrue($userModel->getUpdatedAt() instanceof \DateTime);
        self::assertEquals($userModel->getLogo(), $fixture['logo']);
    }

    public function testFillSubscriptionModelByJson(): void
    {
        $fixture = $this->loadFixture('subscription');
        $subscriptionModel = $this->modelHelper->fillSubscriptionModelByJson($fixture);

        self::assertEquals($subscriptionModel->getId(), $fixture['_id']);
        self::assertTrue($subscriptionModel->getCreatedAt() instanceof \DateTime);
        self::assertEquals($subscriptionModel->getSubPlan(), $fixture['sub_plan']);
        self::assertEquals($subscriptionModel->getSubPlanName(), $fixture['sub_plan_name']);
        self::assertTrue($subscriptionModel->getUser() instanceof TwitchUser);
        self::assertNull($subscriptionModel->getChannel());
    }

    public function testFillVideoModelByJson(): void
    {
        $fixture = $this->loadFixture('video');
        $videoModel = $this->modelHelper->fillVideoModelByJson($fixture);

        self::assertEquals($videoModel->getId(), $fixture['_id']);
        self::assertEquals($videoModel->getBroadcastId(), $fixture['broadcast_id']);
        self::assertEquals($videoModel->getBroadcastType(), $fixture['broadcast_type']);
        self::assertTrue($videoModel->getCreatedAt() instanceof \DateTime);
        self::assertEquals($videoModel->getDescription(), $fixture['description']);
        self::assertEquals($videoModel->getDescriptionHtml(), $fixture['description_html']);
        self::assertEquals($videoModel->getFps(), $fixture['fps']);
        self::assertEquals($videoModel->getGame(), $fixture['game']);
        self::assertEquals($videoModel->getLanguage(), $fixture['language']);
        self::assertEquals($videoModel->getLength(), $fixture['length']);
        self::assertNotEmpty($videoModel->getMutedSegments());
        self::assertEquals($videoModel->getPreview(), $fixture['preview']);
        self::assertTrue($videoModel->getPublishedAt() instanceof \DateTime);
        self::assertEquals($videoModel->getStatus(), $fixture['status']);
        self::assertEquals($videoModel->getTagList(), $fixture['tag_list']);
        self::assertNotEmpty($videoModel->getThumbnails());
        self::assertEquals($videoModel->getTitle(), $fixture['title']);
        self::assertEquals($videoModel->getUrl(), $fixture['url']);
        self::assertEquals($videoModel->getViewable(), $fixture['viewable']);
        self::assertTrue($videoModel->getViewableAt() instanceof \DateTime);
        self::assertEquals($videoModel->getViews(), $fixture['views']);
        self::assertTrue($videoModel->getChannel() instanceof TwitchChannel);
    }

    public function testFillVideoThumbnailsModelByJson(): void
    {
        $fixture = $this->loadFixture('video')['thumbnails']['large'];
        $thumbnailsModel = $this->modelHelper->fillVideoThumbnailsModelByJson($fixture);

        self::assertEquals($thumbnailsModel[0]->getType(), $fixture[0]['type']);
        self::assertEquals($thumbnailsModel[0]->getUrl(), $fixture[0]['url']);
    }

    public function testFillVideoMutedSegmentsModelByJson(): void
    {
        $fixture = $this->loadFixture('video')['muted_segments'][0];
        $mutedSegmentModel = $this->modelHelper->fillVideoMutedSegmentsModelByJson($fixture);

        self::assertEquals($mutedSegmentModel->getDuration(), $fixture['duration']);
        self::assertEquals($mutedSegmentModel->getOffset(), $fixture['offset']);
    }

    public function testFillStreamModelByJson(): void
    {
        $fixture = $this->loadFixture('stream');
        $streamModel = $this->modelHelper->fillStreamModelByJson($fixture);

        self::assertEquals($streamModel->getId(), $fixture['_id']);
        self::assertEquals($streamModel->getGame(), $fixture['game']);
        self::assertEquals($streamModel->getViewers(), $fixture['viewers']);
        self::assertEquals($streamModel->getVideoHeight(), $fixture['video_height']);
        self::assertEquals($streamModel->getAverageFps(), $fixture['average_fps']);
        self::assertEquals($streamModel->getDelay(), $fixture['delay']);
        self::assertTrue($streamModel->getCreatedAt() instanceof \DateTime);
        self::assertEquals($streamModel->isPlaylist(), $fixture['is_playlist']);
        self::assertEquals($streamModel->getPreview(), $fixture['preview']);
        self::assertTrue($streamModel->getChannel() instanceof TwitchChannel);
    }

    public function testFillTeamModelByJson(): void
    {
        $fixture = $this->loadFixture('team');
        $teamModel = $this->modelHelper->fillTeamModelByJson($fixture);

        self::assertEquals($teamModel->getId(), $fixture['_id']);
        self::assertEquals($teamModel->getBackground(), $fixture['background']);
        self::assertEquals($teamModel->getBanner(), $fixture['banner']);
        self::assertTrue($teamModel->getCreatedAt() instanceof \DateTime);
        self::assertEquals($teamModel->getDisplayName(), $fixture['display_name']);
        self::assertEquals($teamModel->getInfo(), $fixture['info']);
        self::assertEquals($teamModel->getLogo(), $fixture['logo']);
        self::assertEquals($teamModel->getName(), $fixture['name']);
        self::assertTrue($teamModel->getUpdatedAt() instanceof \DateTime);
    }

    public function testFillValidateModelByJson(): void
    {
        $validateFixture = $this->loadFixture('validate');
        $userFixture = $this->loadFixture('user');

        $userModel = $this->modelHelper->fillUserModelByJson($userFixture);
        $validateModel = $this->modelHelper->fillValidateModelByJson($validateFixture, $userModel);

        self::assertEquals($validateFixture['client_id'], $validateModel->getClientId());
        self::assertEquals($validateFixture['login'], $validateModel->getLogin());
        self::assertEquals($validateFixture['scopes'], $validateModel->getScope());
        self::assertEquals($validateFixture['user_id'], $validateModel->getUserId());
        self::assertEquals($userModel, $validateModel->getUser());
    }
}
