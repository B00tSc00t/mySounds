<?php
require("../../config.php");

// Retrieve song from database without refreshing page.
if(isset($_POST['albumId'])) {
    $albumId = $_POST['albumId'];

    $query = mysqli_query($conn, "SELECT * FROM albums WHERE id='$albumId'");

    $resultArray = mysqli_fetch_array($query);

    echo json_encode($resultArray);
}

?>