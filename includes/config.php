<?php

    ob_start(); // wait until you have all the data before sending to the server
    /**
     * Need this line of code to allow sessions for app
     */
    session_start();
    
    $timezone = date_default_timezone_set("America/Denver");

    $conn = mysqli_connect("localhost", "root", "", "mysounds");

    if(mysqli_connect_errno()) {
        echo "Failed to connect: " . mysqli_connect_errno();
    }

?>