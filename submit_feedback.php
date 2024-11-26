<?php
include 'config/dbconnect.php';
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["SubmitFeedback"])) {
    $feedback = $_POST["feedback"];
    $currentDate = $_POST["feedback_date"];

    $sql = "INSERT INTO feedback (comment, date) VALUES ('$feedback', '$currentDate')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "Feedback submitted successfully!";
        header("location: home.html");
    } 
}

$conn->close();
?>
