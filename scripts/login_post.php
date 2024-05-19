<?php

require_once "../scripts/connection.php";

session_start();
$errors = [];

if (isset($_POST["login_user"])) {
    $username = sanitize($_POST["username"]);
    $password = sanitize($_POST["password"]);

    if (count($errors) == 0) {
        $password = md5($password);
        $stmt = $conn->prepare("SELECT * FROM tblusers WHERE col_username = ? AND col_password = ? ");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $_SESSION["username"] = $username;
            $_SESSION["success"] = "You are now logged in";
            redirectTo("dashboard.php");
        } else {
            $errors[] = "Wrong Username and Password combination";
        }
    }
}

function sanitize($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}

function redirectTo($location) {
    header("Location: " . $location);
    exit();
}

