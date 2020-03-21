<?php

namespace Padhie\Tests\Model;

use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchModelInterface;
use Padhie\TwitchApiBundle\Model\TwitchStream;
use PHPUnit\Framework\TestCase;

class TwitchStreamTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $fixture = FixtureHelper::loadJsonFixture('stream');
        $streamModel = TwitchStream::createFromJson($fixture);

        self::assertSame($fixture['_id'], $streamModel->getId());
        self::assertSame($fixture['game'], $streamModel->getGame());
        self::assertSame($fixture['viewers'], $streamModel->getViewers());
        self::assertSame($fixture['video_height'], $streamModel->getVideoHeight());
        self::assertSame($fixture['average_fps'], $streamModel->getAverageFps());
        self::assertSame($fixture['delay'], $streamModel->getDelay());
        self::assertSame($fixture['created_at'], $streamModel->getCreatedAt()->format(TwitchModelInterface::DATETIME_FORMAT));
        self::assertSame($fixture['is_playlist'], $streamModel->isPlaylist());
        self::assertNotEmpty($streamModel->getPreview());
        self::assertNotEmpty($streamModel->getChannel());
    }

}