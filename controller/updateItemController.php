<?php
include_once "../config/dbconnect.php";
error_reporting(E_ERROR | E_PARSE);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['record'])) {
    $ID = $_POST['record'];
    $name = $_POST['p_name'] ?? '';
    $venue = $_POST['p_desc'] ?? '';
    $price = $_POST['p_price'] ?? '';

    // Handle image upload if a new image is provided
    if ($_FILES['newImage']['name']) {
        $target_dir = "./uploads/";
        $newImagePath = $target_dir . basename($_FILES["newImage"]["name"]);
        
        if (move_uploaded_file($_FILES["newImage"]["tmp_name"], $newImagePath)) {
            echo "<script>alert('Record added successfully.');window.location.href = '../index.php';</script>";
        } else {
            echo "<script>alert('Record added successfully.');window.location.href = '../index.php';</script>";
            error_log("File upload error: " . $_FILES["newImage"]["error"]);
        }
        
        
        
    } else {
        // If no new image is provided, use the existing image path
        $newImagePath = $_POST['existingImage'];
    }
    error_log("Target directory: " . $target_dir);
     error_log("New image path: " . $newImagePath);

    // Update the database
    $updateQuery = "UPDATE product SET E_name='$name', E_venue='$venue', price='$price', Event_image='$newImagePath' WHERE E_id='$ID'";
    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
