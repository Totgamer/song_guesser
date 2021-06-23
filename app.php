<?php
session_start();
require 'vendor/autoload.php';

$api = new SpotifyWebAPI\SpotifyWebAPI();

// Fetch the saved access token from somewhere. A session for example.
if(!isset($_SESSION["spotifyAccesToken"])) {
    header('location: auth.php');
} else {
    $accessToken = $_SESSION["spotifyAccesToken"];
}
$api->setAccessToken($accessToken);

// It's now possible to request data about the currently authenticated user

// top tracks
$artists = array(
    '6jJ0s89eD6GaHleKKya26X',
    '64KEffDW9EtZ1y2vBYgq8T', 
    '0SfsnGyD8FpIN4U4WCkBZ5', 
    '0C8ZW7ezQVs4URX5aX7Kqx', 
    '1uNFoZAHBGtllmzznpCI3s',
    '4MCBfE4596Uoi2O4DtmEMz',
    '2ylIKKdMukkuprCgY4ZDFE',
);
$tracksPreview = array();
foreach($artists as $artist) {
    $topTracks = $api->getArtistTopTracks($artist, ['country' => 'nl'])->tracks;
    foreach($topTracks as $trackId){
        if($api->getTrack($trackId->id)->preview_url != null){
            array_push($tracksPreview, $api->getTrack($trackId->id));
        }
    }
}
session_destroy();
session_start();
$_SESSION['tracks'] = $tracksPreview;

//random songs generator
$numbers = range(0, count($tracksPreview)-1);
shuffle($numbers);
array_slice($numbers, 0, 2);

$awnser_num = rand(0, count($tracksPreview)-1);
if($awnser_num == $numbers[0] || $awnser_num == $numbers[1]) {
    $awnser_num = rand(0, count($tracksPreview)-1);
}

$_SESSION['awnser_num'] = $awnser_num;

$answers = array($tracksPreview[$_SESSION['awnser_num']]->name, $tracksPreview[$numbers[0]]->name, $tracksPreview[$numbers[1]]->name);
shuffle($answers);

// echo json_encode($tracksPreview);
// echo "<br>";
// echo $tracksPreview[0]->name;
// echo "<br>";
// echo $tracksPreview[0]->preview_url;