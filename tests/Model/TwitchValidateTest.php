<?php

namespace Padhie\Tests\Model;

use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Model\TwitchValidate;
use PHPUnit\Framework\TestCase;

class TwitchValidateTest extends TestCase
{
    final public function testCreateFromJson(): void
    {
        $fixture = FixtureHelper::loadJsonFixture('validate');
        $validateModel = TwitchValidate::createFromJson($fixture);

        self::assertSame($fixture['client_id'], $validateModel->getClientId());
        self::assertSame($fixture['login'], $validateModel->getLogin());
        self::assertSame($fixture['scopes'], $validateModel->getScopes());
        self::assertSame($fixture['user_id'], $validateModel->getUserId());
        self::assertNull($validateModel->getUser());
    }

}