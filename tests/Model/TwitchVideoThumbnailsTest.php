<?php

namespace Padhie\Tests\Model;

use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchVideoThumbnails;
use PHPUnit\Framework\TestCase;

class TwitchVideoThumbnailsTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $fixture = FixtureHelper::loadJsonFixture('video')['thumbnails'];
        $thumbnailsModel = TwitchVideoThumbnails::createFromJson($fixture);

        self::assertNotEmpty($thumbnailsModel->getLarge());
        self::assertNotEmpty($thumbnailsModel->getMedium());
        self::assertNotEmpty($thumbnailsModel->getSmall());
        self::assertNotEmpty($thumbnailsModel->getTemplate());
    }

}