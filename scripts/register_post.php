<?php

include "../scripts/connection.php";

session_start();
$errors = [];

// Check if the registration form is submitted
if (isset($_POST["reg_user"])) {
    // Get and sanitize input values from the form
    $email = mysqli_real_escape_string($conn, $_POST["col_email"]);
    $username = mysqli_real_escape_string($conn, $_POST["col_username"]);
    $password_1 = mysqli_real_escape_string($conn, $_POST["col_password"]);
    $password_2 = mysqli_real_escape_string($conn, $_POST["col_password2"]);

    // Check if both passwords match
    if ($password_1 == $password_2) {
        // Check if email or username already exists
        $user_check_query =
            "SELECT * FROM tblusers WHERE col_username = ? OR col_email = ? LIMIT 1";
        $stmt = $conn->prepare($user_check_query);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            array_push($errors, "Email or Username already exists!");
        } else {
            $hashedpassword = md5($password_1); // Hash the password
            $query =
                "INSERT INTO tblusers (`col_email`,`col_username`,`col_password`) VALUES(?,?,?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $email, $username, $hashedpassword);
            $stmt->execute();

            // Check if the registration was successful
            if ($stmt->affected_rows > 0) {
                $_SESSION["status"] = "Account Created Successfully!";
                header("Location: login.php");
                exit();
            } else {
                array_push($errors, "Error while adding: " . $stmt->error);
            }
        }
    } else {
        array_push($errors, "The two passwords does not match!");
    }
}
?>
