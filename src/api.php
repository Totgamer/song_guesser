<?php
session_start();

require 'vendor/autoload.php';

$api = new SpotifyWebAPI\SpotifyWebAPI();

if(!isset($_SESSION["spotifyAccesToken"])){
    header("location: auth.php");
} else {
    $accessToken = $_SESSION["spotifyAccesToken"];
    $api->setAccessToken($accessToken);
}
print_r(
    $api->me()
);


$device = $api->getMyDevices()->devices ;

// print_r($session);
// echo json_encode($api->me());




foreach($device as $activeDevice) {
    if($activeDevice->is_active === true){
        $currentDevice = $activeDevice->id;
    }
}

if(isset($currentDevice)) {

    // Get top tracks of artist
    $tracks = $api->getArtistTopTracks('0C8ZW7ezQVs4URX5aX7Kqx', [
        'country' => 'nl',
    ])->tracks;
    
    // Check if device is playing
    if($api->getMyCurrentPlaybackInfo()->is_playing === false) {
        // Play if isn't already playing
        $api->play($currentDevice);
    }

    // Loops trough top tracks
    foreach($tracks as $album){
        // Adds top tracks to queue
        $api->queue($album->uri, $currentDevice);
    }
    
    // echo $api->getMyCurrentPlaybackInfo()->item->name;

    // if($_POST['function'] == "next") {
        $api->next($currentDevice);
    // }
}

    // audio feature
    // if(isset($device)) {
    //     // echo json_encode($api->getMultipleAudioFeatures('02XcRGWPkvomFvzTamEKHg'));
    // }
?>