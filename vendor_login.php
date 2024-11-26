<?php
session_start();
require_once "connect.php";

if (isset($_POST['LOGIN'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM vendor WHERE v_mail = ? AND v_pass = ?";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['username'] = $email;
            $_SESSION['v_name'] = $row['v_name'];
            $_SESSION['v_mob'] = $row['v_mob'];
            header('location: vendor_main.php');
            exit();
        } else {
            ?>
            <script>
                window.location.href = "vendor.html";
                alert("Incorrect username or password");
            </script>
            <?php
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error in prepared statement: " . mysqli_error($con);
    }
}
?>
