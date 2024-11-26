<?php
session_start();
include 'connect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['ctr_name'];
    $address = $_POST['ctr_add'];
    $mobile = $_POST['ctr_mob'];
    $email = $_POST['ctr_email'];
    $password = password_hash($_POST['ctr_pass'], PASSWORD_DEFAULT);

    // Ensure that $mobile is treated as a string
    $mobile = strval($mobile);

    // Use prepared statement to prevent SQL injection
    $insertquery = "INSERT INTO users(user_name, user_mail, user_pass, user_mob, user_add) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($insertquery);

    if ($stmt) {
        $stmt->bind_param("sssss", $name, $email, $password, $mobile, $address);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("location: home.html");
            exit();
        } else {
            // Print error details for debugging
            die('Error: ' . $stmt->error);
        }

        $stmt->close();
    } else {
        // Print error details for debugging
        die('Error: ' . $con->error);
    }
}
?>
