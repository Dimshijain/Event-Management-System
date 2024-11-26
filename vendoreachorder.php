<?php
session_start();
?>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Product Name</th>
                <th>Order Status</th>
                <th>Payment Status</th>
            </tr>
        </thead>
        <?php
        include_once "config/dbconnect.php";
        if (isset($_GET['detail_id'])) {
            $detail_id = $_GET['detail_id'];


           
       $sql = "SELECT * FROM orders, order_details WHERE orders.order_no = order_details.detail_id AND order_details.detail_id = $detail_id";


            $result = $conn->query($sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    $count = 1; 
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $row["detail_id"] ?></td>
                            <td><?= $row["E_name"] ?></td>
                            <td>
                                <?php
                                if ($row["order_status"] == 0) {
                                    ?>
                                    <form method="post" action="updateOrderStatus.php">
                                    <input type="hidden" name="detail_id" value="<?= $row['detail_id'] ?>">
                                        <button type="submit" class="btn btn-danger" name="mark_delivered">Pending</button>
                                    </form>
                                    <?php
                                } else {
                                    ?>
                                    <button class="btn btn-success" >Delivered</button>
                                    <?php
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($row["pay_status"] == 0) {
                                    ?>
                                    <button class="btn btn-danger" onclick="ChangePay('<?= $row['detail_id'] ?>')">Unpaid</button>
                                    <?php
                                } else {
                                    ?>
                                    <button class="btn btn-success" onclick="ChangePay('<?= $row['detail_id'] ?>')">Paid</button>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        $count++;
                    }
                } else {
                    echo '<tr><td colspan="4">No matching orders found for the user.</td></tr>';
                }
            } else {

                echo '<tr><td colspan="4">Error fetching orders: ' . $conn->error . '</td></tr>';
            }
        }
        ?>
    </table>
</div>
