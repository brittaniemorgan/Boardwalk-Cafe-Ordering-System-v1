<?php
session_start();
require "DBManager.php";
$host = 'localhost';
$username = 'boardwalk_user';
$password = 'password123';
$dbname = 'cafeInfo';
$db = new DBManager($host, $username, $password, $dbname);
$conn = $db -> getConn();
$items = "";

$foodID = (int) $_POST["foodID"];
$stmt = $conn->query("SELECT * FROM menuItems WHERE id = $foodID");
$results = $stmt->fetchAll()[0];
$name =$results["name"];
$price = $results["price"];
if (isset($_POST["mealSize"])){
    $size = $_POST["mealSize"];
}
else{
    $size = "REG";
}


$comments = $_POST["comments"];
    if (isset($_POST['foodID'])) {
        $foodID = (int)$_POST['foodID'];
        $stmt = $conn->query("SELECT * FROM menuItems WHERE id = $foodID");
        $product = $stmt->fetchAll()[0];
   
    }
    array_push($_SESSION['user'][2], $product);
    $products = $_SESSION['user'][2];
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
        
        <h1 class="title-name">Boardwalk Cafe's Checkout</h1>
        <div class="Cart-Container">
            <div class="Header">
                <h3 class="Cart">Your Cart</h3>
            </div>
            <form action="placeOrder.php" method="post">
                <?php if (!$products): ?>
                    <p>You have no products added in your Shopping Cart</p>
                <?php else:?>
                <div class="Cart-Items">
                    <table>
                        <th>
                            <td>Items</td>
                            <td>Price</td>
                        </th>
                        <?php   
                            $total = 0;
                            foreach($products as $product): 
                                $total += $product['price'];
                                $items .= $product['id'] . " " . $size . ",";
                        ?>
                        <tr>
                            <td class="name"><?=$product['name']?></td>
                        <?php if(isset($_POST['size'])){?>
                            <td ><?=$product['name']?></td>
                        <?php} 
                        else{?>
                            <td class="name"><?=$product['name']?> (<?=$size?>)</td>
                        <?php }?>
                        <td><?=$product['price']?></td>
                        </tr>
                        <?php endforeach;?>
                    </table>
                </div>              


                
                <?php 
                    endif; 
                    $items = rtrim($items,",");
                ?>
                
                <div class="checkout">
                    <div class="total">
                        <div>
                            <div class="Total-checkout">Total</div>
                        </div>
                        <div class="total-value">$<?=$total?>.00</div>
                    </div>

                    <p><label for="general-location">General Location:</label></p>
                    
                    <select name="glocation" required>
                        <option value="UWI" >UWI</option>
                        <option value="Papine" >Papine</option>
                        <option value="Mona" >Mona</option>
                        <option value="Hope Pastures" >Hope Pastures</option>
                        <option value="Jamaica College" >Jamaica College</option>
                        <option value="Old Hope Road" >Old Hope Road</option>
                    </select>

                    <p><label for="address">Steet Address:</label></p>
                    <textarea id="address" name="address" rows="3" cols="40" required></textarea>
                    


                    <button type="submit" class="button-checkout">Checkout</button>
                </div>
                <textarea name="total" value="<?=$items?>" hidden><?=$total?></textarea>
                <textarea name="items" value="<?=$items?>" hidden><?=$items?></textarea>

            </form>
        </div>

    </body>
</html>
