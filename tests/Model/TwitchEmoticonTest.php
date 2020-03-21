<?php

namespace Padhie\Tests\Model;

use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchEmoticon;
use PHPUnit\Framework\TestCase;

class TwitchEmoticonTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $fixture = FixtureHelper::loadJsonFixture('emoticon');
        $emoticonModel = TwitchEmoticon::createFromJson($fixture);

        self::assertSame($fixture['id'], $emoticonModel->getId());
        self::assertSame($fixture['regex'], $emoticonModel->getRegex());
        self::assertNotEmpty($emoticonModel->getImages());
    }
}