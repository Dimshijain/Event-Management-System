<?php
include_once "../config/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];

    $name = $_FILES['file_upload']['name'];
    $temp = $_FILES['file_upload']['tmp_name'];

    $location = "./uploads/";
    $image = $location . $name;

    $target_dir = "./uploads/";
    $finalImage = $target_dir . $name;

    move_uploaded_file($temp, $finalImage);

    $insert = mysqli_query($conn, "INSERT INTO product (E_name, E_venue, Event_image, price) 
        VALUES ('$productName', '$desc', '$image', $price)");

    if (!$insert) {
        echo "Error: " . mysqli_error($conn);
    } else {
        echo "Record added successfully.";
        // Redirect or do further processing if needed
    }
}
?>
