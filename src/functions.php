<?php
session_start();

if(isset($_POST['song']) && $_POST['song'] == $_SESSION['tracks'][$_SESSION['awnser_num']]->name) {
    echo "true";
} elseif(isset($_POST['song'])) {
    echo "false";
}