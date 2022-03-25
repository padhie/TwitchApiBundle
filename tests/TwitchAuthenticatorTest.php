<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Tests;

use Padhie\TwitchApiBundle\TwitchAuthenticator;
use PHPUnit\Framework\TestCase;

final class TwitchAuthenticatorTest extends TestCase
{
    private const CLIENT_ID = 'any-client-id';
    private const REDIRECT_URL = 'any-redirect-uri';

    private TwitchAuthenticator $twitchAuthenticator;

    protected function setUp(): void
    {
        $this->twitchAuthenticator = new TwitchAuthenticator(self::CLIENT_ID, self::REDIRECT_URL);
    }

    public function testGetAccessTokenUrl(): void
    {
        $accessTokenUrl = $this->twitchAuthenticator->getAccessTokenUrl([
            'any-scope'
        ]);

        self::assertStringContainsString(self::CLIENT_ID, $accessTokenUrl);
        self::assertStringContainsString(self::REDIRECT_URL, $accessTokenUrl);
        self::assertStringContainsString('any-scope', $accessTokenUrl);
    }
}