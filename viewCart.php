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

    <body>
       
    <!-- Just added -->
    <h1 class="title-name">Boardwalk Cafe's Checkout</h1>
    <!--  -->
    <div class="Cart-Container">
        <div class="Header">
            <h3 class="Cart">Your Cart</h3> <!--
            <table>
                <tr>
                    <th>Items</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Cost</th>
                    <th>Comments</th>
                </tr>
                <?php foreach($items as $item): ?>
                <tr>
                    <td><?=$item[0]?></td>
                    <td><?=$item[1]?></td>
                    <td><?=$item[2]?></td>
                    <td><?=$item[3]?></td>
                    <td><?=$item[4]?></td>
                </tr>
                <?php endforeach?>
            </table> -->
            <h5 class="Remove">Remove All</h5>
        </div>

        <div class="Cart-Items">
        <?php foreach($items as $item): ?>
            <div class="info">
                <h1 class="name"><?=$item[0]?> (<?=$item[1]?>)</h1>
            </div>

            <div class="quantity"><?=$item[2]?></div>
            <div class="prices"><?=$item[3]?></div>
        </div>   
        
        <div class="count">
            <div class="button">-</div>
            <div class="num">0</div>
            <div class="button">+</div>
        </div>

        <div class="price">
            <div class="amount">$0.00</div>
            <button class="remove">Remove</button>
        </div>
        
        <hr>
        <?php endforeach?>
        <div class="checkout">
            <div class="total">
                <div>
                    <div class="Total-checkout">Total</div>
                    <div class="Totalitem">X items</div>
                </div>
                <div class="total-value">$0.00</div>
            </div>
            <button class="button-checkout">Checkout</button>
        </div>
    </div>

</body>
</html>
Footer
© 2022 GitHub, Inc.
Footer navigation
Terms
Privacy
