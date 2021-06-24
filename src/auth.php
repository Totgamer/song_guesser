<?php
session_start();

require '../vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    'badcf443afad4f57b2374381ea43a034',
    '9171d7ebaaa64a4ebeaecba96ed1984e',
    'http://localhost/school/spotify/song/'
);

$session->requestCredentialsToken();
$accessToken = $session->getAccessToken();


$_SESSION["spotifyAccesToken"] = $accessToken;
// Store the access token somewhere. In a database for example.

// Send the user along and fetch some data!

header('Location: ' . $session->getAuthorizeUrl());
die();