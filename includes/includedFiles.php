<?php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    require("includes/config.php");
    require("includes/classes/User.php");
    require("includes/classes/Artist.php");
    require("includes/classes/Album.php");
    require("includes/classes/Song.php");
    require("includes/classes/Playlist.php");

    if(isset($_GET['userLoggedIn'])) {
        $userLoggedIn = new User($conn, $_GET['userLoggedIn']);
    } else {
        echo "Username variable was not passed into page. Check the openPage JS function.";
        exit();
    }
    } else {
    include("includes/header.php");
    include("includes/footer.php");

    $url = $_SERVER['REQUEST_URI'];
    echo "<script>openPage('$url')</script>";
    exit();
}

?>