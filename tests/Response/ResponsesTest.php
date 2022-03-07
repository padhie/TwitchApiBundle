<?php

declare(strict_types=1);

namespace Padhie\Tests\Response;

use Generator;
use Padhie\Tests\FixtureHelper;
use Padhie\TwitchApiBundle\Response;
use Padhie\TwitchApiBundle\Response\ResponseInterface;
use PHPStan\Testing\TestCase;

final class ResponsesTest extends TestCase
{
    public function dataProviderResponses(): Generator
    {
        yield ['start_commercial', Response\Ads\StartCommercialResponse::class];

        yield ['get_extension_analytics', Response\Analytics\GetExtensionAnalyticsResponse::class];
        yield ['get_game_analytics', Response\Analytics\GetGameAnalyticsResponse::class];
        yield ['get_bits_leaderboard', Response\Analytics\GetBitsLeaderboardResponse::class];
        yield ['get_cheermotes', Response\Analytics\GetCheermotesResponse::class];
        yield ['get_extension_transactions', Response\Analytics\GetExtensionTransactionsResponse::class];
        yield ['get_channel_information', Response\Analytics\GetChannelInformationResponse::class];
        yield ['204 No Content', Response\Analytics\ModifyChannelInformationResponse::class]; // ???
        yield ['get_channel_editors', Response\Analytics\GetChannelEditorsResponse::class];
        yield ['create_custom_rewards', Response\Analytics\CreateCustomRewardsResponse::class];
        yield ['204 No Content', Response\Analytics\DeleteCustomRewardResponse::class]; // ???
        yield ['get_custom_reward', Response\Analytics\GetCustomRewardResponse::class];
        yield ['get_custom_reward_redemption', Response\Analytics\GetCustomRewardRedemptionResponse::class];
        yield ['update_custom_reward', Response\Analytics\UpdateCustomRewardResponse::class];

        yield ['get_user_follows', Response\Users\GetUsersFollowsResponse::class];
    }

    /**
     * @dataProvider dataProviderResponses
     */
    public function testResponses(string $fixtureName, string $responseClass): void
    {
        $response = FixtureHelper::loadJsonFixture($fixtureName);

        self::assertTrue(method_exists($responseClass, 'createFromArray'));
        $responseObject = call_user_func([$responseClass, 'createFromArray'], $response);

        self::assertInstanceOf(ResponseInterface::class, $responseObject);
    }
}