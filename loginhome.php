<?php
session_start();
include 'connect.php';

if (isset($_POST['Login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT user_pass FROM users WHERE user_mail='$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['user_pass'];

        if (password_verify($password, $storedPassword)) {
            $_SESSION['user_mail'] = $email;
            header("location: order.php");
            exit();
        } else {
            echo "<script>alert('Incorrect email or password');window.location.href = 'home.html';</script>";
        }
    } else {
        echo "<script>alert('Incorrect email or password');window.location.href = 'home.html';</script>";
    }

    mysqli_close($con);
}
?>
