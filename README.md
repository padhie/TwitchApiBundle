# TwitchApi
A little collection to work with the Twitch-Api https://dev.twitch.tv/docs/v5/

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