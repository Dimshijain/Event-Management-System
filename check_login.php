<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // User is authenticated
    echo 'authenticated';
} else {
    // User is not authenticated
    echo 'not_authenticated';
}
?>
