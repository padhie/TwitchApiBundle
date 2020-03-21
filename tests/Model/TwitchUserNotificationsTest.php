<?php

namespace Padhie\Tests\Model;

use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchModelInterface;
use Padhie\TwitchApiBundle\Model\TwitchUser;
use Padhie\TwitchApiBundle\Model\TwitchUserNotifications;
use PHPUnit\Framework\TestCase;

class TwitchUserNotificationsTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $fixture = FixtureHelper::loadJsonFixture('user')['notifications'];
        $userNotificationsModel = TwitchUserNotifications::createFromJson($fixture);

        self::assertSame($fixture['email'], $userNotificationsModel->isEmail());
        self::assertSame($fixture['push'], $userNotificationsModel->isPush());
    }

}