# TwitchApi
A little collection to work with the Twitch-Api https://dev.twitch.tv/docs/api/reference

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
$request = new \Padhie\TwitchApiBundle\Request\Channel\GetChannelRequest($broadcasterId);

$response = $client->send($request);
assert($response instanceof \Padhie\TwitchApiBundle\Request\Channel\GetChannelResponse);

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
* [ ] implement namespaces
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
  * [ ] Subscriptions
  * [ ] Tags
  * [ ] Teams
  * [ ] Users
  * [ ] Videos
* [ ] tests with response examples (from Documentation)
* [ ] implement Async / Parallel request