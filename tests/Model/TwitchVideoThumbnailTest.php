<?php

namespace Padhie\Tests\Model;

use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchVideoThumbnail;
use PHPUnit\Framework\TestCase;

class TwitchVideoThumbnailTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $fixture = FixtureHelper::loadJsonFixture('video')['thumbnails']['large'][0];
        $thumbnailModel = TwitchVideoThumbnail::createFromJson($fixture);

        self::assertSame($fixture['type'], $thumbnailModel->getType());
        self::assertSame($fixture['url'], $thumbnailModel->getUrl());
    }

}