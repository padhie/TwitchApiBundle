<?php

namespace Padhie\Tests\Model;

use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchChannel;
use Padhie\TwitchApiBundle\Model\TwitchFollower;
use Padhie\TwitchApiBundle\Model\TwitchModelInterface;
use PHPUnit\Framework\TestCase;

class TwitchFollowerTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $fixture = FixtureHelper::loadJsonFixture('follow');
        $followerModel = TwitchFollower::createFromJson($fixture);

        self::assertSame($fixture['created_at'], $followerModel->getCreatedAt()->format(TwitchModelInterface::DATETIME_FORMAT_DETAILED));
        self::assertSame($fixture['notifications'], $followerModel->isNotifications());
        self::assertNotEmpty($followerModel->getUser());
        self::assertNull($followerModel->getChannel());
    }
}