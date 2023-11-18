# TwitchApi
Simple Client for Twitch-Api https://dev.twitch.tv/docs/api/reference

## How to use
### Create Client
```php
// see https://dev.twitch.tv/docs/authentication/getting-tokens-oauth
$clientId = 'CLIENT_ID';
$authorization = 'AUTHORIZATION';

$client = new \Padhie\TwitchApiBundle\TwitchClient(
    new \GuzzleHttp\Client(),
    new \Padhie\TwitchApiBundle\Request\RequestGenerator($clientId, $authorization),
    new \Padhie\TwitchApiBundle\Response\ResponseGenerator(),
);

```

### send Single Request
```php
$request = new \Padhie\TwitchApiBundle\Request\Channels\GetChannelInformationRequest($broadcasterId);

$response = $client->send($request);
assert($response instanceof \Padhie\TwitchApiBundle\Response\Channels\GetChannelInformationResponse);

$title = $response->getChannels()[0]->getTitle();
```

### send Pagination Request
```php
$request = new \Padhie\TwitchApiBundle\Request\Users\GetUsersFollowsRequest($broadcasterId);

$response = $client->sendWithPagination($request);
assert($response instanceof \Padhie\TwitchApiBundle\Request\Users\GetUsersFollowsResponse);

$users = $response->getUsers();
```


## Todo
* [ ] implement Namespaces
  * [x] Ads
  * [x] Analytics
  * [x] Bits
  * [ ] ChannelPoints
  * [x] Channels
  * [ ] Chat
  * [ ] Clips
  * [ ] Entitlements
  * [ ] EventSub
  * [ ] Extensions
  * [x] Games
  * [x] Goals
  * [ ] HypeTrain
  * [ ] Moderation
  * [ ] Music
  * [ ] Polls
  * [ ] Predictions
  * [ ] Schedule
  * [ ] Search
  * [ ] Streams
  * [x] Subscriptions
  * [ ] Tags
  * [ ] Teams
  * [ ] Users
  * [x] Videos
* [ ] tests with Response Examples (from Documentation)
* [x] implement Parallel Request
* [ ] implement Async Request