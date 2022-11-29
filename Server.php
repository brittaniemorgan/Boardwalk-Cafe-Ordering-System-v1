<script src="script.js"></script>
<?php
    require "DBManager.php";
    require "Employee.php";
    class Server extends Employee{
        
        /*function __construct($name, $username, $password, $dbmanager){
            $stmt = $this->conn->query("SELECT * FROM `orders` WHERE `status` = 'OPEN'");
            $this->orders = $stmt->fetchAll();  
        }*/
        function updateStatus($orderId){
            $stmt = $this->conn->prepare("UPDATE `orders` SET `status` = 'READY' WHERE `id` = :orderId");
            $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            
            if($stmt->execute()){
                    echo 'status updated';
            }else{
                    echo 'couldnt updated status';
            }
            $this->viewOrders();
           
        }

        public function viewOrders(){
            $stmt = $this->conn->query("SELECT * FROM `orders` WHERE `status` = 'OPEN'");
            $orders = $stmt->fetchAll();
            foreach($orders as $order):
            ?>
            <h2>Orders</h2>
            <div id="orderDiv<?=$order["id"]?>">
                <h3>Order #<?=$order["id"]?></h3>
                <ul><?php
                    $items = explode(",",$order["items"]);
                    foreach($items as $item):
                        $foodID = (int) substr($item,0,2);
                        $foodItems = $this->conn->query("SELECT * FROM menuItems WHERE id =$foodID");
                        $foodResult = $foodItems->fetchAll();
                        $foodName = $foodResult[0]["name"];
                ?>
                    
                        <li id="<?=$order["id"]?>>"><?=$foodName?>, <?=substr($item,3)?></li>
                    <?php endforeach?>
                </ul>
                <p class="order-status">Status: <?=$order["status"]?></p>
                <button id="<?=$order["id"]?>" class="mark-ready">Mark as Ready</button>
            <?php endforeach?>
                
        <?php }
    }
    function okay(){
        echo "okay";
    }
    $host = 'localhost';
    $username = 'boardwalk_user';
    $password = 'password123';
    $dbname = 'cafeInfo';

    $db = new DBManager($host, $username, $password, $dbname);
    $server = new Server("john", "john123", "pwd123", $db);
    $server->viewOrders();
    if (isset($_GET["orderId"])){
        $server->updateStatus($_GET["orderId"]);
    }

?>