<?php
require("../../config.php");

// Retrieve song from database without refreshing page.
if(isset($_POST['songId'])) {
    $songId = $_POST['songId'];

    $query = mysqli_query($conn, "SELECT * FROM songs WHERE id='$songId'");

    $resultArray = mysqli_fetch_array($query);

    echo json_encode($resultArray);
}

?>