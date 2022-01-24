<?php

require("includes/config.php");
require("includes/classes/Artist.php");
require("includes/classes/Album.php");
require("includes/classes/Song.php");
require("includes/classes/User.php");
require("includes/classes/Playlist.php");

/**
 * session_destroy(); is used to kill sessions, if you don't alredy have a logout function
 * Good for testing your code
 */
// session_destroy();

if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = new User($conn, $_SESSION['userLoggedIn']);
    $username = $userLoggedIn->getUsername();
    echo "<script>userLoggedIn = '$username'</script>";
} else {
    header("Location: register.php");
}

?>

<html>
<head>
  <title>My Sounds</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">

  <!-- This ajax line must go above the javascript line -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="assets/js/script.js"></script>
</head>
<body>

    <div id="mainContainer">

        <div id="topContainer">

            <?php include("includes/navBarContainer.php"); ?>

            <div id="mainViewContainer">

                <div id="mainContent">