<?php
require("../../config.php");

// Retrieve song from database without refreshing page.
if(isset($_POST['artistId'])) {
    $artistId = $_POST['artistId'];

    $query = mysqli_query($conn, "SELECT * FROM artists WHERE id='$artistId'");

    $resultArray = mysqli_fetch_array($query);

    echo json_encode($resultArray);
}

?>