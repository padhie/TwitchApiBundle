# TwitchApi
A little collection to work with the Twitch-Api https://dev.twitch.tv/docs/api/reference

## How to use
```php
<?php
use TwitchApiBundle\Service\TwitchApiService;

$twitchApiService = new TwitchApiService('client_Id', 'client_secret', 'redirekt_url');

// get authorisation url
$url = $twitchApiService->getAccessTokenUrl(TwitchApiService::SCOPE_CHANNEL);

// set access token
$twitchApiService->setOAuth('access_token');

// get own user data
$user = $twitchApiService->getUser();

// get own channel data
$channel = $twitchApiService->getChannel();
```

--------------------

```php
<?php

// see https://dev.twitch.tv/docs/authentication/getting-tokens-oauth
$clientId = 'CLIENT_ID';
$authorization = 'AUTHORIZATION';

$client = new \Padhie\TwitchApiBundle\TwitchClient(
    new \GuzzleHttp\Client(),
    new \Padhie\TwitchApiBundle\Request\RequestGenerator($clientId, $authorization)
);

$request = new \Padhie\TwitchApiBundle\Request\Channel\GetChannelRequest($broadcasterId);

$response = $client->send($request);
assert($response instanceof \Padhie\TwitchApiBundle\Request\Channel\GetChannelResponse);

$title = $response->getTitle();
```