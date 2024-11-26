<div class="container p-5">

    <h4>Edit Product Detail</h4>

    <?php
    include_once "../config/dbconnect.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['record'])) {
        $ID = $_POST['record'];
        $qry = mysqli_query($conn, "SELECT * FROM product WHERE E_id='$ID'");
        $numberOfRow = mysqli_num_rows($qry);

        if ($numberOfRow > 0) {
            while ($row1 = mysqli_fetch_array($qry)) {
                ?>
                <form id="update-Items" action="controller/updateItemcontroller.php" enctype='multipart/form-data' method="POST">


                    <div class="form-group">
                        <?php if (isset($row1['E_id'])): ?>
                            <input type="text" class="form-control" id="E_id" name="record" value="<?= $row1['E_id'] ?>" hidden>

                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                       <label for="name">Event Name:</label>
                       <input type="text" class="form-control" id="p_name" name="p_name" required>
                    </div>
                    <div class="form-group">
                        <label for="desc">Event Venue:</label>
                        <input type="text" class="form-control" id="p_desc" name="p_desc" required>

                    </div>
                    <div class="form-group">
                       <label for="price">Price:</label>
                       <input type="number" class="form-control" id="p_price" name="p_price" required>
                    </div>
                    <div class="form-group">
                          <?php if (isset($row1["Event_image"])): ?>
                            <img width='200px' height='150px' src='<?= $row1["Event_image"] ?>'>
                    <div>
                             <label for="newImage">Choose New Image:</label>
                             <input type="file" id="newImage" name="newImage">
                            <input type="hidden" name="existingImage" value="<?= $row1['Event_image'] ?>">
                    </div>
                         <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" style="height:40px" class="btn btn-primary">Update Item</button>
                    </div>
                </form>
                <?php
            }
        } else {
            echo "No records found.";
        }
    } else {
        echo "Record parameter is not set.";
    }
    ?>

</div>
