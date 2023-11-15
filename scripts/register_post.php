<?php

include "../scripts/connection.php";

session_start();
$errors = array();

if (isset($_POST["reg_user"])) {
    // receive all input values from the form
    $email = mysqli_real_escape_string($conn, $_POST["col_email"]);
    $username = mysqli_real_escape_string($conn, $_POST["col_username"]);
    $password_1 = mysqli_real_escape_string($conn, $_POST["col_password"]);
    $password_2 = mysqli_real_escape_string($conn, $_POST["col_password2"]);

    // check if both password are the same
    if ($password_1 == $password_2) {
            $user_check_query = "SELECT * FROM tblusers WHERE col_username ='$username' OR col_email ='$email' LIMIT 1";
            $result = mysqli_query($conn, $user_check_query);

            //checks if email alrdy exists
            if (mysqli_num_rows($result) > 0) {
                array_push($errors, "Email or Username already exists!");
            } else {
                $hashedpassword = md5($password_1); //Encrypt the password before saving in the database
                $query = "INSERT INTO tblusers (`col_email`,`col_username`,`col_password`) VALUES('$email','$username','$hashedpassword')";
                $query_run = mysqli_query($conn, $query);

                if (!$result) {
                    die("Error while adding!!!...") . mysqli_error($conn);
                } else {
                    //registration successful message
                    $_SESSION ['status'] = "Account Created Successfully!";
                    header("Location: login.php");
                    exit();
                }
            }
    } else {
        //password dont match
        array_push($errors, "The two passwords does not match!");
    }
}
?>
