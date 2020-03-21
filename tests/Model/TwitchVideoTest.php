<?php

namespace Padhie\Tests\Model;

use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchModelInterface;
use Padhie\TwitchApiBundle\Model\TwitchVideo;
use PHPUnit\Framework\TestCase;

class TwitchVideoTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $fixture = FixtureHelper::loadJsonFixture('video');
        $videoModel = TwitchVideo::createFromJson($fixture);

        self::assertSame($fixture['_id'], $videoModel->getId());
        self::assertSame($fixture['broadcast_id'], $videoModel->getBroadcastId());
        self::assertSame($fixture['broadcast_type'], $videoModel->getBroadcastType());
        self::assertNotEmpty($videoModel->getChannel());
        self::assertSame($fixture['created_at'], $videoModel->getCreatedAt()->format(TwitchModelInterface::DATETIME_FORMAT));
        self::assertSame($fixture['description'], $videoModel->getDescription());
        self::assertSame($fixture['description_html'], $videoModel->getDescriptionHtml());
        self::assertNotEmpty($videoModel->getFps());
        self::assertSame($fixture['game'], $videoModel->getGame());
        self::assertSame($fixture['language'], $videoModel->getLanguage());
        self::assertSame($fixture['length'], $videoModel->getLength());
        self::assertNotEmpty($videoModel->getPreview());
        self::assertNotEmpty($videoModel->getMutedSegments());
        self::assertSame($fixture['published_at'], $videoModel->getPublishedAt()->format(TwitchModelInterface::DATETIME_FORMAT));
        self::assertNotEmpty($videoModel->getResolutions());
        self::assertSame($fixture['status'], $videoModel->getStatus());
        self::assertSame($fixture['tag_list'], $videoModel->getTagList());
        self::assertNotEmpty($videoModel->getThumbnails());
        self::assertSame($fixture['title'], $videoModel->getTitle());
        self::assertSame($fixture['url'], $videoModel->getUrl());
        self::assertSame($fixture['viewable'], $videoModel->getViewable());
        self::assertNull($videoModel->getViewableAt());
        self::assertSame($fixture['views'], $videoModel->getViews());
    }

}