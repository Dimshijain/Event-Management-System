<?php
$server="localhost";
$username="root";
$password="";
$database="SWISS_collection";
$con=mysqli_connect($server,$username,$password,$database);
if ($con->connect_error) {
    $error = array('error' => 'Connection failed: ' . $con->connect_error);
    header('Content-Type: application/json');
    echo json_encode($error);
    exit();
}

$sql = "SELECT * FROM product";
$result = $con->query($sql);

$products = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$con->close();


header('Content-Type: application/json');


if (!empty($products)) {
    echo json_encode($products);
} else {
    $error = array('error' => 'No products found.');
    echo json_encode($error);
}
?>





