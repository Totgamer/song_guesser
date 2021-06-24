<?php
session_start();

if(isset($_POST['song']) && $_POST['song'] == $_SESSION['tracks'][$_SESSION['awnser_num']]->name) {
    echo "true";
} elseif(isset($_POST['song'])) {
    echo "false";
}

if(isset($_POST['next']) && $_POST['next'] == "next") {

    //random songs generator
    $numbers = range(0, count($_SESSION['tracks'])-1);
    shuffle($numbers);
    array_slice($numbers, 0, 2);

    $awnser_num = rand(0, count($_SESSION['tracks'])-1);
    if($awnser_num == $numbers[0] || $awnser_num == $numbers[1]) {
        $awnser_num = rand(0, count($_SESSION['tracks'])-1);
    }

    $_SESSION['awnser_num'] = $awnser_num;

    $answers = array($_SESSION['tracks'][$_SESSION['awnser_num']]->name, $_SESSION['tracks'][$numbers[0]]->name, $_SESSION['tracks'][$numbers[1]]->name);
    shuffle($answers);
    array_push($answers, $_SESSION['tracks'][$_SESSION['awnser_num']]->preview_url);
    echo json_encode($answers);
}