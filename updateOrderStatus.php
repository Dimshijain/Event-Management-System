<?php
session_start();
include_once "config/dbconnect.php";

if (isset($_SESSION['v_name'], $_SESSION['v_mob'])) {
    $v_name = $_SESSION['v_name'];
    $v_mobile = $_SESSION['v_mob'];
} else {
    echo "Session variables are not set.";
    exit;
}

if (isset($_POST['detail_id'])) {
    $orderNo = $_POST['detail_id'];
} else {
    echo "Form data (detail_id) is not set.";
    exit;
}

$insertSql = "INSERT INTO order_expect (order_no, order_date, E_name, price, v_name, v_mob ) 
              SELECT orders.order_no, orders.order_date, order_details.E_name, orders.price, ?, ? 
              FROM orders 
              JOIN order_details ON orders.order_no = order_details.detail_id 
              WHERE orders.order_no = ?";
$insertStmt = $conn->prepare($insertSql);

if ($insertStmt) {
    $insertStmt->bind_param("ssi", $v_name, $v_mobile, $orderNo);
    $insertStmt->execute();

    if ($insertStmt->affected_rows > 0) {
        $updateSql = "UPDATE order_details SET order_status = 1 WHERE detail_id = ?";
        $updateStmt = $conn->prepare($updateSql);

        if ($updateStmt) {
            $updateStmt->bind_param("i", $orderNo);
            $updateStmt->execute();

            if ($updateStmt->affected_rows > 0) {
                header('location: vendor_main.php');
            }
        }
    } else {
        echo "Failed to accept the order. Error: " . $insertStmt->error;
    }

    $insertStmt->close();
} else {
    echo "Error preparing insert statement: " . $conn->error;
}

$conn->close();
?>
