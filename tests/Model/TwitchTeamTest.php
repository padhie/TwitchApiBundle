<?php

namespace Padhie\Tests\Model;

use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchModelInterface;
use Padhie\TwitchApiBundle\Model\TwitchTeam;
use PHPUnit\Framework\TestCase;

class TwitchTeamTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $fixture = FixtureHelper::loadJsonFixture('team');
        $streamModel = TwitchTeam::createFromJson($fixture);

        self::assertSame($fixture['_id'], $streamModel->getId());
        self::assertSame($fixture['background'], $streamModel->getBackground());
        self::assertSame($fixture['banner'], $streamModel->getBanner());
        self::assertSame($fixture['created_at'], $streamModel->getCreatedAt()->format(TwitchModelInterface::DATETIME_FORMAT));
        self::assertSame($fixture['display_name'], $streamModel->getDisplayName());
        self::assertSame($fixture['info'], $streamModel->getInfo());
        self::assertSame($fixture['logo'], $streamModel->getLogo());
        self::assertSame($fixture['name'], $streamModel->getName());
        self::assertSame($fixture['updated_at'], $streamModel->getUpdatedAt()->format(TwitchModelInterface::DATETIME_FORMAT));
    }

}