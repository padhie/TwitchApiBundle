<?php

namespace Padhie\Tests\Model;

use Padhie\tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchEmoticon;
use Padhie\TwitchApiBundle\Model\TwitchEmoticonImage;
use PHPUnit\Framework\TestCase;

class TwitchEmoticonImageTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $firstFixture = FixtureHelper::loadJsonFixture('emoticon')['images'][0];
        $firstEmoticonImageModel = TwitchEmoticonImage::createFromJson($firstFixture);

        self::assertSame($firstFixture['width'], $firstEmoticonImageModel->getWidth());
        self::assertSame($firstFixture['height'], $firstEmoticonImageModel->getHeight());
        self::assertSame($firstFixture['url'], $firstEmoticonImageModel->getUrl());
        self::assertSame($firstFixture['emoticon_set'], $firstEmoticonImageModel->getEmoticonSet());
        self::assertSame(0, $firstEmoticonImageModel->getId());
        self::assertSame('', $firstEmoticonImageModel->getCode());


        $secondFixture = FixtureHelper::loadJsonFixture('emoticon')['images'][1];
        $secondEmoticonImageModel = TwitchEmoticonImage::createFromJson($secondFixture);

        self::assertSame($secondFixture['id'], $secondEmoticonImageModel->getId());
        self::assertSame($secondFixture['code'], $secondEmoticonImageModel->getCode());
        self::assertSame($secondFixture['emoticon_set'], $secondEmoticonImageModel->getEmoticonSet());
        self::assertSame(0, $secondEmoticonImageModel->getWidth());
        self::assertSame(0, $secondEmoticonImageModel->getHeight());
        self::assertSame('', $secondEmoticonImageModel->getUrl());

    }
}