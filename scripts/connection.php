<?php

$conn = mysqli_connect("localhost", "webapp", "password123", "appdb");

if (!$conn) {
    die("Error while connecting...!") . mysqli_connect_error($conn);
}

?>
