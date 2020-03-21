<?php

namespace Padhie\Tests\Model;

use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchChannelSubscriptions;
use PHPUnit\Framework\TestCase;

class TwitchChannelSubscriptionsTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $fixture = FixtureHelper::loadJsonFixture('channel_subscriptions');
        $channelSubscriptionsModel = TwitchChannelSubscriptions::createFromJson($fixture);

        self::assertSame($fixture['_total'], $channelSubscriptionsModel->getTotal());
        self::assertNotEmpty($channelSubscriptionsModel->getSubscriptions());
    }

}