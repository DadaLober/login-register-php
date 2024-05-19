<?php

$conn = mysqli_connect("localhost", "root", "", "appdb");

if (!$conn) {
    die("Error while connecting...!") . mysqli_connect_error($conn);
}

?>
