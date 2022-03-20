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
    new \Padhie\TwitchApiBundle\Request\RequestGenerator($clientId, $authorization)
);

```

### send Single Request
```php
$request = new \Padhie\TwitchApiBundle\Request\Channels\GetChannelRequest($broadcasterId);

$response = $client->send($request);
assert($response instanceof \Padhie\TwitchApiBundle\Request\Channels\GetChannelResponse);

$title = $response->getTitle();
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
  * [ ] Goals
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
  * [ ] Videos
* [ ] tests with Response Examples (from Documentation)
* [x] implement Parallel Request
* [ ] implement Async Request