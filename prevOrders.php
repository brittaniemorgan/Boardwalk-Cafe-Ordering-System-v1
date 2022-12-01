<?php
    require "DBManager.php";
    session_start();
    $SESSION['user'] = [2, "Mary", []];
    $host = 'localhost';
    $username = 'boardwalk_user';
    $password = 'password123';
    $dbname = 'cafeInfo';

    $cusId = $SESSION['user'][0];

    $db = new DBManager($host, $username, $password, $dbname);
    
    $conn = $db->getConn(); 
    $stmt = $conn->query("SELECT * FROM orders WHERE cusId = $cusId ORDER BY date ASC");//dbManager?
    $orders = $stmt->fetchAll();
    foreach($orders as $order):
?>
    <div class="order">
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
        <p>Status: <?=$order['status']?></p>
        <?php if($order['status'] == 'OPEN'):?>
            <button class="cancel-order-btn" onclick="cancelOrder(<?=$order['id']?>)">Cancel</button>
        <?php endif?>
    </div>
<?php endforeach;
    function cancelOrder($db,$orderID){
        $db->deleteOrder($orderID);
    }
?>

                
        
