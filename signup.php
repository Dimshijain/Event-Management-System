<?php
session_start();
include 'connect.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['ctr_name']);
    $address = mysqli_real_escape_string($con, $_POST['ctr_add']);
    $mobile = mysqli_real_escape_string($con, $_POST['ctr_mob']);
    $email = mysqli_real_escape_string($con, $_POST['ctr_email']);
    $password = $_POST['ctr_pass'];

    $insertquery = "INSERT INTO vendor(v_name, v_mail, v_pass, v_mob) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $insertquery);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $password, $mobile);
        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            header("location: vendor.html");
            exit();
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
