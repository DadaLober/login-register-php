<?php

include "../scripts/connection.php";

session_start();
$errors = array();

if (isset($_POST["login_user"])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    if (count($errors) == 0)
    {
        $password = md5($password);
        $query = "SELECT * FROM tblusers WHERE col_username ='$username' AND col_password ='$password'";
        $results = mysqli_query($conn, $query);
        if (mysqli_num_rows($results) == 1)
        {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: dashboard.php');
        }
        else
        {
            array_push($errors, "Wrong Username and Password combination");
        }
    }
}

?>