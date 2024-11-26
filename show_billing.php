<?php
include 'config/dbconnect.php';

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Feedback</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Billing Data</h2>
    <?php
    $sql = "SELECT * FROM bill";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Invoice</th><th>Orderno</th><th>v_name</th><th>user_id</th><th>vendor no</th><th>user no</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["invoice"] . "</td>";
            echo "<td>" . $row["order_no"] . "</td>";
            echo "<td>" . $row["v_name"] . "</td>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td>" . $row["v_mob"] . "</td>";
            echo "<td>" . $row["user_mob"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No BILLING data found.";
    }

    mysqli_close($conn);
    ?>
</body>
</html>
