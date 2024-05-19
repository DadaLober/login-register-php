<?php

require_once "../scripts/connection.php";

session_start();
$errors = [];

if (isset($_POST["reg_user"])) {
    var_dump($_POST);
    $data = sanitizeFormData($conn, $_POST);

    if ($data["password"] === $data["confirm_password"]) {
        $userExists = userExists($conn, $data["username"], $data["email"]);

        if ($userExists) {
            $errors[] = "Email or Username already exists!";
        } else {
            $hashedPassword = md5($data["password"]);
            $registrationSuccessful = registerUser($conn, $data["email"], $data["username"], $hashedPassword);

            if ($registrationSuccessful) {
                $_SESSION["status"] = "Account Created Successfully!";
                header("Location: login.php");
                exit();
            } else {
                $errors[] = "Error while adding: " . $stmt->error;
            }
        }
    } else {
        $errors[] = "The two passwords do not match!";
    }
}

function sanitizeFormData($conn, $data)
{
    $sanitizedData = [];
    foreach ($data as $key => $value) {
        $sanitizedData[$key] = mysqli_real_escape_string($conn, $value);
    }
    return $sanitizedData;
}

function userExists($conn, $username, $email)
{
    $query = "SELECT * FROM tblusers WHERE col_username = ? OR col_email = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

function registerUser($conn, $email, $username, $hashedPassword)
{
    $query = "INSERT INTO tblusers (`col_email`,`col_username`,`col_password`) VALUES(?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $email, $username, $hashedPassword);
    $stmt->execute();
    return $stmt->affected_rows > 0;
}

