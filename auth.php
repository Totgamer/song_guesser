<?php
session_start();

require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    'badcf443afad4f57b2374381ea43a034',
    '9171d7ebaaa64a4ebeaecba96ed1984e',
    'http://localhost/school/spotify/song/'
);

$state = $session->generateState();
$options = [
    'scope' => [
        'user-read-email',
        'user-read-playback-state',
        'streaming',
        'user-read-private',
    ],
    'state' => $state,
];

$session->requestCredentialsToken();
$accessToken = $session->getAccessToken();


$_SESSION["spotifyAccesToken"] = $accessToken;
$_SESSION["storedState"] = $state;
// Store the access token somewhere. In a database for example.

// Send the user along and fetch some data!

header('Location: ' . $session->getAuthorizeUrl($options));
die();