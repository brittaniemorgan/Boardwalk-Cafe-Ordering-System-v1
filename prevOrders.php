<script src="prevOrders.js" type="text/javascript"></script>
<?php
    require "DBManager.php";
    session_start();
    $host = 'localhost';
    $username = 'boardwalk_user';
    $password = 'password123';
    $dbname = 'cafeInfo';

    $cusId = $_SESSION['user'][0];

    $db = new DBManager($host, $username, $password, $dbname);
    $GLOBALS['db'] = $db;
    $conn = $db->getConn(); 
    $stmt = $conn->query("SELECT * FROM orders WHERE cusId = $cusId ORDER BY status DESC");//dbManager?
    $orders = $stmt->fetchAll();
    foreach($orders as $order):
?>
    <div class="order" id="order-<?=$order["date"]?>">
        <p>Order Date: <?=$order["date"]?></p>
        <ul>
        <?php $items = explode(", ",$order['items']);
                foreach($items as $item):
                    $foodID = explode(" ", $item)[0];
                    $foodSize = explode(" ", $item)[1];
                    $menuStmt = $conn->query("SELECT * FROM menuitems WHERE id = $foodID");
                    $foodName = $menuStmt->fetchAll()[0]['name'];
        ?>
            <li><?=$foodName?> (<?=$foodSize?>)</li>
            <?php endforeach?>
        </ul>
        <p>Address: <?=$order['address']?>, <?=$order['gen_del_location']?></p>
        <p>Total: <?=$order['total']?></p>
        <?php if ($order['status'] == 'CLSD' && $order['delivered'] == 'NO'):?>
            <p>Status: Your order is on the way!</p>
        <?php elseif ($order['delivered'] == 'YES'):?>
            <p>Status: Your order has been delivered. Enjoy!</p>
        <?php elseif($order['status'] == 'OPEN'):?>
            <p>Status: Your order has been received.</p>
            <button class="cancel-order-btn" id="<?=$order['id']?>">Cancel</button>
        <?php elseif($order['status'] == 'PREP'):?>
            <p>Status: Your order is being prepared.</p>
            <button class="cancel-order-btn" id="<?=$order['id']?>">Cancel</button>
        <?php endif?>
    </div>
<?php endforeach;

    if (isset($_GET['orderId'])){
        $GLOBALS['db']->deleteOrder((int) $_GET['orderId']);
    }
?>

                
        
