<?php

include "../scripts/connection.php";

session_start();
$errors = [];

if (isset($_POST["login_user"])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    if (count($errors) == 0) {
        $password = md5($password);
        $query =
            "SELECT * FROM tblusers WHERE col_username = ? AND col_password = ? ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $_SESSION["username"] = $username;
            $_SESSION["success"] = "You are now logged in";
            header("location: dashboard.php");
        } else {
            array_push($errors, "Wrong Username and Password combination");
        }
    }
}

?>
