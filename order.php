
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Menu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
            border: 15px solid linear-gradient(to right, #ff6b6b, #784ba0); 
            border-radius: 15px;
            padding: 20px;
        }

        .container {
            margin-top: 30px;
        }

        .logout-icon {
            float: right;
            font-size: 24px;
            color: #fff;
            margin-top: -10px;
            cursor: pointer;
        }
    

        .title-container {
            background-color: #e83e8c; 
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
            text-align: center;
        }

        .title {
            color: #fff; 
            margin: 0;
        }

        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-img-top {
            max-height: 200px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-border {
            border: 5px solid transparent;
            background-clip: padding-box;
            border-image: linear-gradient(to right, #ff6b6b, #784ba0); 
            border-image-slice: 1;
        }

        .card-body {
            text-align: center;
        }

        .card-title {
            font-size: 1.5rem;
            margin-top: 10px;
            color: #343a40; 
        }

        .card-text {
            color: #6c757d; 
        }

        .btn-success {
            background-color: #28a745; 
            border: none;
            transition: background-color 0.3s;
        }

        .btn-success:hover {
            background-color: #218838; 
        }
        .cart-icon{
            float: left;
            font-size: 24px;
            color: #fff;
            margin-top: -10px;
            cursor: pointer;

        }
    </style>
</head>
<body>

<div class="container">
    <div class="title-container">
        <h2 class="title"> Event Menu</h2>
        <a href="wishlist.php" style="text-decoration:none;">
        <i class="fas fa-shopping-cart cart-icon" style="font-size: 24px; color: #fff; margin-right: 10px;"></i>


        </a>
        <a href="logout.php" style="text-decoration:none;">
   
         <i class="fas fa-sign-out-alt logout-icon" id="logoutIcon"></i>
        </a>
    </div>
    <div class="row" id="productMenu">
        
  
    </div>
    
</div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $.getJSON('getProducts.php', function (data) {
            populateProductMenu(data);
        }).fail(function (jqxhr, textStatus, error) {
            var err = textStatus + ', ' + error;
            console.error("Request Failed: " + err);
        });

        function populateProductMenu(products) {
            var productMenu = $('#productMenu');
            productMenu.empty();

            products.forEach(function (product) {
                var card = $('<div>').addClass('card col-md-4 mb-3 card-border');
                var img = $('<img>').addClass('card-img-top').attr('src', product.Event_image).attr('alt', product.E_name);
                var cardBody = $('<div>').addClass('card-body');
                var title = $('<h5>').addClass('card-title').text(product.E_name);
                var venue = $('<p>').addClass('card-text').text('Venue: ' + product.E_venue);
                var price = $('<p>').addClass('card-text').text('Price: $' + product.price);

                var bookOrderBtn = $('<button>').addClass('btn btn-success btn-block').text('Book Now');
                bookOrderBtn.click(function () {
                    window.location.href = 'order_details.php?event=' + encodeURIComponent(product.E_name) +
                        '&venue=' + encodeURIComponent(product.E_venue) +
                        '&price=' + encodeURIComponent(product.price) +
                        '&image=' + encodeURIComponent(product.Event_image);
                });

                cardBody.append(img, title, venue, price, bookOrderBtn);
                card.append(cardBody);
                productMenu.append(card);
            });
        }
    });
</script>

</body>
</html>
