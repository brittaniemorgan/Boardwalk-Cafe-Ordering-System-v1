<script src="script.js"></script>
<?php
    require "DBManager.php";
    require "Employee.php";
    class Server extends Employee{
        
        /*function __construct($name, $username, $password, $dbmanager){
            $stmt = $this->conn->query("SELECT * FROM `orders` WHERE `status` = 'OPEN'");
            $this->orders = $stmt->fetchAll();  
        }*/
        function updateOrder($orderId, $action){
            if($action == "updateReady"){
                $time = date("h:i a");
                $stmt = $this->conn->prepare("UPDATE `orders` SET `status` = 'CLSD', `end_time` = :time WHERE `id` = :orderId");
                //UPDATE `orders` SET `status` = 'CLSD', `end_time` = "90" WHERE `id` = 4;
                $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
                $stmt->bindParam(':time', $time, PDO::PARAM_STR);
            
                if($stmt->execute()){
                        echo 'status updated';
                }else{
                        echo 'couldnt updated status';
                }
            }
            if($action == "updatePrepare"){
                $stmt = $this->conn->prepare("UPDATE `orders` SET `status` = 'PREP' WHERE `id` = :orderId");
                $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            
                if($stmt->execute()){
                        echo 'status updated';
                }else{
                        echo 'couldnt updated status';
                }
            }
            $this->viewOrders();
           
        }

        public function viewOrders(){
            $stmt = $this->conn->query("SELECT * FROM `orders` WHERE `status` = 'OPEN' OR `status` = 'PREP' ORDER BY `start_time` ASC");
            $orders = $stmt->fetchAll();
           ?>
            <h2>Orders</h2>
            <?php foreach($orders as $order):?>
            
            <div id="orderDiv<?=$order["id"]?>">
                <h3>Order #<?=$order["id"]?></h3>
                <ul><?php
                    $items = explode(",",$order["items"]);
                    foreach($items as $item):
                        $foodID = (int) substr($item,0,2);
                        $foodItems = $this->conn->query("SELECT * FROM menuItems WHERE id =$foodID");
                        $foodResult = $foodItems->fetchAll();
                        $foodName = $foodResult[0]["name"];
                        $foodCategory = $foodResult[0]["category"];
                ?>
                    
                        <li id="<?=$order["id"]?>>"><?=$foodName?>, <?=substr($item,2)?></li>
                        <p class="item-category">Category: <?=$foodCategory?></p>
                    <?php endforeach?>
                </ul>
                <p class="order-status-" id="order-status-<?=$order["id"]?>">Status: <?=$order["status"]?></p>
                <button id="<?=$order["id"]?>" class="mark-preparing">Mark as Preparing</button>
                <button id="<?=$order["id"]?>" class="mark-ready">Mark as Ready</button>
            </div>
            <?php endforeach?>
            
                
        <?php }
    }
    $host = 'localhost';
    $username = 'boardwalk_user';
    $password = 'password123';
    $dbname = 'cafeInfo';

    $db = new DBManager($host, $username, $password, $dbname);
    $server = new Server("john", "john123", "pwd123", $db);
    $server->viewOrders();
    if (isset($_GET["orderId"]) && isset($_GET['action'])){
        $server->updateOrder($_GET["orderId"], $_GET['action']);
    }

?>