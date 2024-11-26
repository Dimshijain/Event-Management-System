<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["eventName"])) {
        $eventName = $_POST["eventName"];

        // Assuming your products are stored in some array, for example, in getProducts.php
        // You need to modify this part based on how your products are structured
        $products = json_decode(file_get_contents('getProducts.php'), true);

        // Find the selected product by event name
        $selectedProduct = null;
        foreach ($products as $product) {
            if ($product['E_name'] == $eventName) {
                $selectedProduct = $product;
                break;
            }
        }

        // Initialize the shopping cart array in the session if not already set
        if (!isset($_SESSION["shoppingCart"])) {
            $_SESSION["shoppingCart"] = array();
        }

        // Add the selected item to the shopping cart in the session
        $_SESSION["shoppingCart"][] = $selectedProduct;

        echo "Item added to cart!";
    } else {
        echo "Invalid request.";
    }
} else {
    echo "Invalid request method.";
}
?>
