<?php

namespace Padhie\Tests\Model;

use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchChannel;
use Padhie\TwitchApiBundle\Model\TwitchModelInterface;
use PHPUnit\Framework\TestCase;

class TwitchChannelTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $fixture = FixtureHelper::loadJsonFixture('channel');
        $channelModel = TwitchChannel::createFromJson($fixture);

        self::assertSame($fixture['mature'], $channelModel->isMature());
        self::assertSame($fixture['status'], $channelModel->getStatus());
        self::assertSame($fixture['broadcaster_language'], $channelModel->getBroadcasterLanguage());
        self::assertSame($fixture['display_name'], $channelModel->getDisplayName());
        self::assertSame($fixture['game'], $channelModel->getGame());
        self::assertSame($fixture['language'], $channelModel->getLanguage());
        self::assertSame($fixture['_id'], $channelModel->getId());
        self::assertSame($fixture['name'], $channelModel->getName());
        self::assertSame($fixture['created_at'], $channelModel->getCreatedAt()->format(TwitchModelInterface::DATETIME_FORMAT));
        self::assertSame($fixture['updated_at'], $channelModel->getUpdatedAt()->format(TwitchModelInterface::DATETIME_FORMAT));
        self::assertSame($fixture['partner'], $channelModel->isPartner());
        self::assertSame($fixture['logo'], $channelModel->getLogo());
        self::assertSame($fixture['video_banner'], $channelModel->getVideoBanner());
        self::assertSame($fixture['profile_banner'], $channelModel->getProfileBanner());
        self::assertSame($fixture['profile_banner_background_color'], $channelModel->getProfileBannerBackgroundColor());
        self::assertSame($fixture['url'], $channelModel->getUrl());
        self::assertSame($fixture['views'], $channelModel->getViews());
        self::assertSame($fixture['followers'], $channelModel->getFollowers());
        self::assertSame($fixture['broadcaster_type'], $channelModel->getBroadcasterType());
        self::assertSame($fixture['stream_key'], $channelModel->getStreamKey());
        self::assertSame($fixture['email'], $channelModel->getEmail());
    }

}