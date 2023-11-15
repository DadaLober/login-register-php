<?php

$conn = mysqli_connect("localhost", "root", "", "lnfdb");

if (!$conn) {
    die("Error while connecting...!") . mysqli_connect_error($conn);
}

?>
