<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Your Order History</h1>

    <?php
    session_start();
    include 'config/dbconnect.php';

    // Check if the user is logged in
    if (!isset($_SESSION['user_mail'])) {
        header("location: home.html"); 
        exit();
    }

    $userEmail = $_SESSION['user_mail'];

    // Retrieve user's ID based on the email
    $queryUserId = "SELECT user_id FROM users WHERE user_mail=?";
    $stmtUserId = mysqli_prepare($conn, $queryUserId);

    if ($stmtUserId) {
        mysqli_stmt_bind_param($stmtUserId, "s", $userEmail);
        mysqli_stmt_execute($stmtUserId);
        $resultUserId = mysqli_stmt_get_result($stmtUserId);

        if ($resultUserId) {
            $rowUserId = mysqli_fetch_assoc($resultUserId);
            $userId = $rowUserId['user_id'];

            // Retrieve user's order history based on user_id
            $queryOrders = "SELECT orders.order_no, orders.order_date, order_details.E_name, orders.price, order_details.pay_status, order_expect.V_name, order_expect.V_mob, order_details.order_status
                            FROM orders 
                            JOIN order_details ON orders.order_no = order_details.detail_id 
                            JOIN order_expect ON order_details.detail_id = order_expect.order_no
                            WHERE orders.user_id=?
                            ORDER BY orders.order_date DESC";
            $stmtOrders = mysqli_prepare($conn, $queryOrders);

            if ($stmtOrders) {
                mysqli_stmt_bind_param($stmtOrders, "i", $userId);
                mysqli_stmt_execute($stmtOrders);
                $resultOrders = mysqli_stmt_get_result($stmtOrders);

                if (!$resultOrders) {
                    // Handle the query error
                    echo 'Error executing query: ' . mysqli_error($conn);
                } elseif (mysqli_num_rows($resultOrders) > 0) {
                    // Display order history in a table
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>Order No</th>';
                    echo '<th>Order Date</th>';
                    echo '<th>Event Name</th>';
                    echo '<th>Price</th>';
                    echo '<th>Vendor Name</th>';
                    echo '<th>Vendor Mobile</th>';
                    echo '<th>Payment Status</th>';
                    echo '</tr>';

                    // Display order details in a table
                    while ($rowOrder = mysqli_fetch_assoc($resultOrders)) {
                        echo '<tr>';
                        echo '<td>' . $rowOrder['order_no'] . '</td>';
                        echo '<td>' . $rowOrder['order_date'] . '</td>';
                        echo '<td>' . $rowOrder['E_name'] . '</td>';
                        echo '<td>' . $rowOrder['price'] . '</td>';

                        if ($rowOrder['order_status'] == 1) {
                            // Display vendor info only when order is accepted
                            echo '<td>' . $rowOrder['V_name'] . '</td>';
                            echo '<td>' . $rowOrder['V_mob'] . '</td>';
                        } else {
                            // Display a placeholder or an empty cell
                            echo '<td></td>';
                            echo '<td></td>';
                        }

                        echo '<td>';
                          if ($rowOrder['pay_status'] == 0) {
                              echo '<button class="btn btn-danger" onclick="changePaymentStatus(' . $rowOrder['order_no'] . ')">Unpaid</button>';
                          } else {
                              echo '<button class="btn btn-success" onclick="ChangePay(' . $rowOrder['order_no'] . ')">Paid</button>';
                            }
                          echo '</td>';
                        echo '</tr>';
                    }

                    echo '</table>';
                } else {
                    // No orders found for the user
                    echo "<p>No order history found.</p>";
                }

                mysqli_stmt_close($stmtOrders);
            } else {
                // Handle the prepared statement error
                echo 'Error preparing statement: ' . mysqli_error($conn);
            }
        } else {
            // Handle the query error
            echo 'Error executing query: ' . mysqli_error($conn);
        }

        mysqli_stmt_close($stmtUserId);
    } else {
        // Handle the prepared statement error
        echo 'Error preparing statement: ' . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
    <script>
    function changePaymentStatus(orderNo) {
        // Confirm with the user if they want to change the payment status
        if (confirm("Are you sure you want to change the payment status to Paid?")) {
            // Send an AJAX request to update payment status
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "billing.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the response, if needed
                    alert(xhr.responseText);
                    // You can also reload the page to update the order history
                    location.reload();
                }
            };
            xhr.send("orderNo=" + orderNo);
        }
    }
</script>


</body>
</html>
