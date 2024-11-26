<?php
session_start();
$user_mail=$_SESSION['user_mail'];
if($user_mail==TRUE){

}
else{
    echo "<script>alert('please login first');window.location.href = 'home.html';</script>";

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            margin-top: 30px;
        }

        .border-rounded {
            border: 1px solid #dee2e6;
            border-radius: 15px;
        }

        .title-container {
            background-color: #e83e8c;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
            text-align: center;
            color: #fff;
        }

        .item-details {
            padding: 20px;
            margin-bottom: 20px;
        }

        .item-details img {
            max-width: 200px;
            border-radius: 10px;
            margin-top: 10px;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center border-rounded bg-light my-5">
                <h1>Your Booking</h1>
            </div>
            <div class="col-lg-8">
            <?php
        
             $itemName = isset($_GET['event']) ? $_GET['event'] : '';
             $_SESSION['itemName'] = $itemName;
              $itemVenue = isset($_GET['venue']) ? $_GET['venue'] : '';
             $itemPrice = isset($_GET['price']) ? intval($_GET['price']) : '';
             $_SESSION['itemPrice']=$itemPrice;
             echo "Debugging: Event Name - " . $itemPrice . "<br>";
             $itemImage = isset($_GET['image']) ? $_GET['image'] : '';
            ?>

                <div class="item-details border-rounded bg-light">
                    <h2>Item Details</h2>
                    <p><strong>Name:</strong> <?php echo $itemName; ?></p>
                    <p><strong>Venue:</strong> <?php echo $itemVenue; ?></p>
                    <p><strong>Price:</strong> $<?php echo $itemPrice; ?></p>
                    <img src="<?php echo $itemImage; ?>" alt="Item Image" style="max-width: 200px;">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-container">
                    <form action="purchase.php" method="POST" enctype="multipart/form-data">
                        <h2>Payment Details</h2>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="full_name"  required>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact:</label>
                            <input type="number" class="form-control" id="contact" name="phone" pattern="[0-9]{10}" title="number must be 10 characters long" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Event Date:</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="purchase">Make Purchase</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
       

    </script>
</body>

</html>
