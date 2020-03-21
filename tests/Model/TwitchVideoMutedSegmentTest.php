<?php

namespace Padhie\Tests\Model;

use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchModelInterface;
use Padhie\TwitchApiBundle\Model\TwitchVideo;
use Padhie\TwitchApiBundle\Model\TwitchVideoMutedSegment;
use PHPUnit\Framework\TestCase;

class TwitchVideoMutedSegmentTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $fixture = FixtureHelper::loadJsonFixture('video')['muted_segments'][0];
        $mutedSegmentsModel = TwitchVideoMutedSegment::createFromJson($fixture);

        self::assertSame($fixture['duration'], $mutedSegmentsModel->getDuration());
        self::assertSame($fixture['offset'], $mutedSegmentsModel->getOffset());
    }

}