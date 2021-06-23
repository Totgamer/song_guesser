<?php
session_start();

require '../vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    'badcf443afad4f57b2374381ea43a034',
    '9171d7ebaaa64a4ebeaecba96ed1984e',
    'http://localhost/school/spotify/song/'
);

$state = $_GET['state'];

// Fetch the stored state value from somewhere. A session for example
$storedState = $_SESSION["storedState"];

if ($state !== $storedState) {
    // The state returned isn't the same as the one we've stored, we shouldn't continue
    die('State mismatch');
}

// Request a access token using the code from Spotify
$session->requestAccessToken($_GET['code']);

$accessToken = $session->getAccessToken();
$refreshToken = $session->getRefreshToken();

// Store the access and refresh tokens somewhere. In a session for example

// Send the user along and fetch some data!
header('Location: app.php');
die();