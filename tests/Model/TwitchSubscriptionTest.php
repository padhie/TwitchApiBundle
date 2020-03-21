<?php

namespace Padhie\Tests\Model;

use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchModelInterface;
use Padhie\TwitchApiBundle\Model\TwitchSubscription;
use PHPUnit\Framework\TestCase;

class TwitchSubscriptionTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $fixture = FixtureHelper::loadJsonFixture('subscription');
        $streamModel = TwitchSubscription::createFromJson($fixture);

        self::assertSame($fixture['_id'], $streamModel->getId());
        self::assertSame($fixture['sub_plan'], $streamModel->getSubPlan());
        self::assertSame($fixture['sub_plan_name'], $streamModel->getSubPlanName());
        self::assertSame($fixture['created_at'], $streamModel->getCreatedAt()->format(TwitchModelInterface::DATETIME_FORMAT));
        self::assertNotEmpty($streamModel->getUser());
        self::assertNull($streamModel->getChannel());
    }

}