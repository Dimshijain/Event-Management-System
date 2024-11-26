<?php
session_start();
include 'config/dbconnect.php';

if (isset($_POST['orderNo'])) {
    $orderNo = $_POST['orderNo'];
    // Assuming you have a table structure where you can update the payment status
    $updatePaymentSql = "UPDATE order_details SET pay_status = 1 WHERE detail_id = ?";
    $stmt = mysqli_prepare($conn, $updatePaymentSql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $orderNo);
        if (mysqli_stmt_execute($stmt)) {
            // Successfully updated payment status
            // Now, store data in the "billing" table
            $insertBillingSql = "INSERT INTO bill (order_no, v_name, user_id, v_mob, user_mob) SELECT order_expect.order_no, order_expect.V_name, orders.user_id, order_expect.V_mob, users.user_mob FROM orders JOIN order_details ON orders.order_no = order_details.detail_id JOIN order_expect ON order_details.detail_id = order_expect.order_no JOIN users ON orders.user_id = users.user_id WHERE orders.order_no = ?";
            $stmtBilling = mysqli_prepare($conn, $insertBillingSql);

            if ($stmtBilling) {
                mysqli_stmt_bind_param($stmtBilling, "i", $orderNo);
                if (mysqli_stmt_execute($stmtBilling)) {
                    echo "Payment status updated and data stored in billing.";
                } else {
                    echo "Error storing data in billing: " . mysqli_error($conn);
                }
                mysqli_stmt_close($stmtBilling);
            } else {
                echo "Error preparing billing statement: " . mysqli_error($conn);
            }
        } else {
            echo "Error updating payment status: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>
