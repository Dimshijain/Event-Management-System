<?php
session_start();

if (!isset($_SESSION['user_mail']) || empty($_SESSION['user_mail'])) {
    echo "<script>alert('Please login first');window.location.href = 'home.html';</script>";
    exit();
}
error_reporting(E_ALL);

$itemName = isset($_SESSION['itemName']) ? $_SESSION['itemName'] : '';
$itemPrice=isset($_SESSION['itemPrice']) ? intval($_SESSION['itemPrice']) :'';
include_once "config/dbconnect.php";

$user_mail = $_SESSION['user_mail'];
$itemVenue = isset($_GET['venue']) ? $_GET['venue'] : ' ';
$fullName = $_POST['full_name'];
$phone = $_POST['phone'];
$date = $_POST['date'];

$query = "INSERT INTO orders (user_id, user_name, phone_no, price, order_date)
          VALUES ((SELECT user_id FROM users WHERE user_mail = '$user_mail' LIMIT 1), '$fullName', '$phone', $itemPrice, '$date')";

$result = mysqli_query($conn, $query);

if ($result) {
    $orderId = mysqli_insert_id($conn);


    $queryItem = "INSERT INTO order_details (detail_id, E_name)
                  VALUES ('$orderId', '$itemName')";
    $resultItem = mysqli_query($conn, $queryItem);

    if ($resultItem) {
        echo "<script>alert('Order placed successfully!');window.location.href = 'logout.php';</script>";
        session_destroy();
    } else {
        echo "SQL Error: " . mysqli_error($conn);
        echo "<script>alert('Failed to insert item details into order_details table');</script>";
    }
} else {
    echo "Error: " . mysqli_error($conn);
    echo "<script>alert('Failed to place the order');</script>";
}

mysqli_close($conn);
?>
