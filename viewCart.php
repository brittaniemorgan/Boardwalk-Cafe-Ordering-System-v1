<?php 
#$_SESSION["user"] = "user123";
require "DBManager.php";
$host = 'localhost';
$username = 'boardwalk_user';
$password = 'password123';
$dbname = 'cafeInfo';
$db = new DBManager($host, $username, $password, $dbname);
$conn = $db -> getConn();

$items = [];
class CartManager{}
$foodID = $_POST["foodID"];
$stmt = $conn->query("SELECT * FROM menuItems WHERE id = $foodID");
$results = $stmt->fetchAll();
$name =$results[0]["name"];
$price = $results[0]["price"];
$size = $_POST["mealSize"];
if (isset($_POST["side"])){
    $side = $_POST["side"];
}
else{
    $side = "";
}

$comments = $_POST["comments"];

array_push($items, [$name,$size,1, $price, $comments]); #work on getting quantity


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="viewCart.css">
</head>
<body>
    <!-- Just added -->
    <h1 class="title-name">Boardwalk Cafe's Checkout</h1>
    <!--  -->
    <div class="Cart-Container">
        <div class="Header">
            <h3 class="Cart">Your Cart</h3>
            <h5 class="Remove">Remove All</h5>
        </div>

        <div class="Cart-Items">
            <?php   
                $total = 0;
                $totalItems = 0;
                foreach($items as $item): 
                $total += $item[3] * $item[2];
                $totalItems += 1 * $item[2];
            ?>
            <div class="info">
                <h1 class="name"><?=$item[0]?> (<?=$item[1]?>)</h1>
            </div>

            <div class="quantity"><?=$item[2]?></div>
            <div class="prices"><?=$item[3]?></div>
        </div>   
        
        <div class="count">
            <div class="button">-</div>
            <div class="num"><?=$item[2]?></div>
            <div class="button">+</div>
        </div>

        <div class="price">
            <div class="amount">$<?=$total?>.00</div>
            <button class="remove">Remove</button>
        </div>

        <hr>
        <?php endforeach?>
        <div class="checkout">
            <div class="total">
                <div>
                    <div class="Total-checkout">Total</div>
                    <div class="Totalitem"><?=$totalItems?> items</div>
                </div>
                <div class="total-value">$<?=$total?>.00</div>
            </div>
            <button class="button-checkout">Checkout</button>
        </div>
    </div>

</body>
</html>