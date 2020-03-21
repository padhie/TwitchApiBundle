<?php

namespace Padhie\Tests\Model;

use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchVideoFps;
use PHPUnit\Framework\TestCase;

class TwitchVideoFpsTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $fixture = FixtureHelper::loadJsonFixture('video')['fps'];
        $fpsModel = TwitchVideoFps::createFromJson($fixture);

        self::assertSame($fixture['chunked'], $fpsModel->getChunked());
        self::assertSame($fixture['high'], $fpsModel->getHigh());
        self::assertSame($fixture['low'], $fpsModel->getLow());
        self::assertSame($fixture['medium'], $fpsModel->getMedium());
        self::assertSame($fixture['mobile'], $fpsModel->getMobile());
    }

}