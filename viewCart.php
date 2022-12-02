<?php
session_start();
require "DBManager.php";
$host = 'localhost';
$username = 'boardwalk_user';
$password = 'password123';
$dbname = 'cafeInfo';
$db = new DBManager($host, $username, $password, $dbname);
$conn = $db -> getConn();
$_SESSION['cart'] = [];
$items = "";
echo $_SESSION['user'][0];
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
    // If the user clicked the add to cart button on the product page we can check for the form data
    if (isset($_POST['foodID'])) {
        // Set the post variables so we easily identify them, also make sure they are integer
        $foodID = (int)$_POST['foodID'];
        // Prepare the SQL statement, we basically are checking if the product exists in our databaser
        //$stmt = $conn->query("SELECT * FROM menuItems WHERE id = $foodID");
       // $product = $stmt->fetchAll();
        $stmt = $conn->query("SELECT * FROM menuItems WHERE id = $foodID");
        //$stmt->execute([$_POST['$foodID']]);
        // Fetch the product from the database and return the result as an Array
        $product = $stmt->fetchAll()[0];
        // Check if the product exists (array is not empty)
   
    }
    array_push($_SESSION['cart'], $product);
    $products = $_SESSION['cart'];
    

/*
if (isset($_POST['checkout']) ) {
    echo "Order received";
    foreach($products as $product){
        echo $product;
    }
    //$db->addOrder($subtotal, join(",",$products), "tbd", "tbd");//fix toString
    //header('Location: placeOrder.php');
    //exit;
}
*/
   // Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
   if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}

#array_push($items, [$name,$size,1, $price, $comments]); #work on getting quantity


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
        <a href="index.php">Home</a>
        <!-- Just added -->
        <h1 class="title-name">Boardwalk Cafe's Checkout</h1>
        <!--  -->
        <div class="Cart-Container">
            <div class="Header">
                <h3 class="Cart">Your Cart</h3>
                <h5 class="Remove">Remove All</h5>
            </div>
            <form action="placeOrder.php" method="post">
                <?php if (empty($_SESSION['cart'])): ?>
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
                                $items .= $product['id'] . " " . $size . ", ";
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

                
                <!--
                <div class="count">
                    <div class="button">-</div>
                    <div class="num">quantity</div>
                    <div class="button">+</div>
                </div>-->

                <div class="price">
                    <div class="amount">$<?=$total?>.00</div>
                    <button class="remove">Remove</button>
                </div>

                <hr>
                
                <?php 
                    endif; 
                    $items = rtrim($items,",");
                ?>
                
                <div class="checkout">
                    <div class="total">
                        <div>
                            <div class="Total-checkout">Total</div>
                            <div class="Totalitem"><?=$totalItems?> items</div>
                        </div>
                        <div class="total-value">$<?=$total?>.00</div>
                    </div>
                    <!--<input type="submit" value="Update" name="update">-->

                    <p><label for="general-location">General Location:</label></p>
                    
                    <select name="glocation" >
                        <option value="UWI" >UWI</option>
                        <option value="Papine" >Papine</option>
                        <option value="Mona" >Mona</option>
                        <option value="Hope Pastures" >Hope Pastures</option>
                        <option value="Jamaica College" >Jamaica College</option>
                        <option value="Old Hope Road" >Old Hope Road</option>
                    </select>

                    <p><label for="address">Steet Address:</label></p>
                    <textarea id="address" name="address" rows="3" cols="40"></textarea>
                    


                    <button type="submit" class="button-checkout">Checkout</button>
                </div>
                <textarea name="total" value="<?=$items?>" hidden><?=$total?></textarea>
                <textarea name="items" value="<?=$items?>" hidden><?=$items?></textarea>

            </form>
        </div>

    </body>
</html>

<?php
/*
///////////////////added
foreach($items as $item): 
    $total += $item[3] * $item[2];
    $totalItems += 1 * $item[2];

    $genLocation = $_GET["location"];
    $address = $_GET["address"];

    function addOrder($total, $items, $genLocation, $address){

        $date = date('d/M/Y');
        $start_time = date('h:i a');
        

        $stmt = $this->conn->prepare("INSERT INTO `orders` (`total`, `items`, `date`, `gen_del_location`, `address`, `start_time`) VALUES (:total, :items, :date, :genLocation, :address, :start_time)");
        $stmt->bindParam(':total', $total, PDO::PARAM_INT);
        $stmt->bindParam(':items', $items, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':genLocation', $genLocation, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':start_time', $start_time, PDO::PARAM_STR);

        if($stmt->execute()){
            echo 'order placed';
        }else{
            echo 'error, couldnt place order';
        }

    }




/////////////////////////////////////////
*/
?>