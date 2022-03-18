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
* [x] implement namespace Ads
* [x] implement namespace Analytics
* [ ] implement namespace Bits
* [ ] implement namespace ChannelPoints
* [ ] implement namespace Channels
* [ ] implement namespace Chat
* [ ] implement namespace Clips
* [ ] implement namespace Entitlements
* [ ] implement namespace EventSub
* [ ] implement namespace Extensions
* [ ] implement namespace Games
* [ ] implement namespace Goals
* [ ] implement namespace HypeTrain
* [ ] implement namespace Moderation
* [ ] implement namespace Music
* [ ] implement namespace Polls
* [ ] implement namespace Predictions
* [ ] implement namespace Schedule
* [ ] implement namespace Search
* [ ] implement namespace Streams
* [ ] implement namespace Subscriptions
* [ ] implement namespace Tags
* [ ] implement namespace Teams
* [ ] implement namespace Users
* [ ] implement namespace Videos