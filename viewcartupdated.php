<?php 
#$_SESSION["user"] = "user123";
require "DBManager.php";
$host = 'localhost';
$username = 'boardwalk_user';
$password = 'password123';
$dbname = 'cafeInfo';
$db = new DBManager($host, $username, $password, $dbname);
$conn = $db -> getConn();

$items = "";
class CartManager{}
$foodID = (int) $_POST["foodID"];
$quantity = (int)$_POST['quantity'];
$stmt = $conn->query("SELECT * FROM menuItems WHERE id = $foodID");
$results = $stmt->fetchAll()[0];
$name =$results["name"];
$price = $results["price"];
$size = $_POST["mealSize"];
if (isset($_POST["side"])){
    $side = $_POST["side"];
}
else{
    $side = "";
}

$comments = $_POST["comments"];
    // If the user clicked the add to cart button on the product page we can check for the form data
    if (isset($_POST['foodID'])) {
        // Set the post variables so we easily identify them, also make sure they are integer
        $foodID = (int)$_POST['foodID'];
        $quantity = (int)$_POST['quantity'];
        // Prepare the SQL statement, we basically are checking if the product exists in our databaser
        //$stmt = $conn->query("SELECT * FROM menuItems WHERE id = $foodID");
       // $product = $stmt->fetchAll();
        $stmt = $conn->query("SELECT * FROM menuItems WHERE id = $foodID");
        //$stmt->execute([$_POST['$foodID']]);
        // Fetch the product from the database and return the result as an Array
        $product = $stmt->fetchAll()[0];
        // Check if the product exists (array is not empty)
        if ($product && $quantity > 0) {
            // Product exists in database, now we can create/update the session variable for the cart
            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                if (array_key_exists($foodID, $_SESSION['cart'])) {
                    
                    // Product exists in cart so just update the quanity
                    $_SESSION['cart'][$foodID] += $quantity;
                } else {
                    // Product is not in cart so add it
                    
                    $_SESSION['cart'][$foodID] = $quantity;
                }
            } else {
                //There are no products in cart, this will add the first product to cart
                $_SESSION['cart'] = array($foodID => $quantity);
            }
        }
    }
    $products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
   $products = array();
   $subtotal = 0.00;
   // If there are products in cart
   if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $conn->prepare('SELECT * FROM menuItems WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }
}
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
        <!-- Just added -->
        <h1 class="title-name">Boardwalk Cafe's Checkout</h1>
        <!--  -->
        <div class="Cart-Container">
            <div class="Header">
                <h3 class="Cart">Your Cart</h3>
                <h5 class="Remove">Remove All</h5>
            </div>
            <form action="placeOrder.php" method="post">
                <?php if (empty($products)): ?>
                    <p>You have no products added in your Shopping Cart</p>
                <?php else:?>
                <div class="Cart-Items">
                    <?php   
                        $total = 0;
                        $totalItems = 0;
                        foreach($products as $product): 
                            $items .= $product['id'] . " " . $size . ",";
                            $total += $product['price'] * $quantity;
                        #$totalItems += 1 * $item[2];
                    ?>
                    
                    <div class="info">
                        <h1 class="name"><?=$product['name']?> (<?=$size?>)</h1>
                    </div>

                    <div class="quantity">
                        <input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$product['id']]?>" min="1" max="10" placeholder="Quantity" required>
                    </div>
                    <div class="prices"><?=$product['price']*$quantity?></div>
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
                <?php endforeach;?>
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
                    <textarea id="glocation" name="glocation" rows="2" cols="30">></textarea>

                    <p><label for="address">Address:</label></p>
                    <textarea id="address" name="address" rows="3" cols="40">></textarea>
                    


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