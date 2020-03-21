<?php

namespace Padhie\Tests\Model;

use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchVideoResolutions;
use PHPUnit\Framework\TestCase;

class TwitchVideoResolutionsTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $fixture = FixtureHelper::loadJsonFixture('video')['resolutions'];
        $resolutionsModel = TwitchVideoResolutions::createFromJson($fixture);

        self::assertSame($fixture['chunked'], $resolutionsModel->getChunked());
        self::assertSame($fixture['high'], $resolutionsModel->getHigh());
        self::assertSame($fixture['low'], $resolutionsModel->getLow());
        self::assertSame($fixture['medium'], $resolutionsModel->getMedium());
        self::assertSame($fixture['mobile'], $resolutionsModel->getMobile());
    }

}