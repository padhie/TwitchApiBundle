<?php

namespace Padhie\Tests\Model;

use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchModelInterface;
use Padhie\TwitchApiBundle\Model\TwitchUser;
use PHPUnit\Framework\TestCase;

class TwitchUserTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $fixture = FixtureHelper::loadJsonFixture('user');
        $userModel = TwitchUser::createFromJson($fixture);

        self::assertSame($fixture['_id'], $userModel->getId());
        self::assertSame($fixture['bio'], $userModel->getBio());
        self::assertSame($fixture['created_at'], $userModel->getCreatedAt()->format(TwitchModelInterface::DATETIME_FORMAT));
        self::assertSame($fixture['display_name'], $userModel->getDisplayName());
        self::assertSame($fixture['email'], $userModel->getEmail());
        self::assertSame($fixture['email_verified'], $userModel->isEmailVerified());
        self::assertSame($fixture['logo'], $userModel->getLogo());
        self::assertSame($fixture['name'], $userModel->getName());
        self::assertNotNull($userModel->getNotifications());
        self::assertSame($fixture['partnered'], $userModel->isPartnered());
        self::assertSame($fixture['twitter_connected'], $userModel->isTwitterConnected());
        self::assertSame($fixture['type'], $userModel->getType());
        self::assertSame($fixture['updated_at'], $userModel->getUpdatedAt()->format(TwitchModelInterface::DATETIME_FORMAT));
    }

}