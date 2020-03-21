<?php

namespace Padhie\Tests\Model;

use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchModelInterface;
use Padhie\TwitchApiBundle\Model\TwitchVideo;
use Padhie\TwitchApiBundle\Model\TwitchVideoMutedSegment;
use Padhie\TwitchApiBundle\Model\TwitchVideoPreview;
use PHPUnit\Framework\TestCase;

class TwitchVideoPreviewTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $fixture = FixtureHelper::loadJsonFixture('video')['preview'];
        $previewModel = TwitchVideoPreview::createFromJson($fixture);

        self::assertSame($fixture['large'], $previewModel->getLarge());
        self::assertSame($fixture['medium'], $previewModel->getMedium());
        self::assertSame($fixture['small'], $previewModel->getSmall());
        self::assertSame($fixture['template'], $previewModel->getTemplate());
    }

}