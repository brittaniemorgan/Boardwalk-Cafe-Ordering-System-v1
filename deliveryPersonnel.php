<?php
    session_start();
    if (isset($_SESSION['deliveryPersonnel'])) {
        unset($_SESSION['deliveryPersonnel']);
        header('Location: index.php');
    }

    require_once "AuthAdmin.php";
    $error_message = '';
    if (isset($_POST['submit'])) {
        $auth = new AuthAdmin();
        $response = $auth->verifyAdmin($_POST['username'], $_POST['password']);
        $error_message = '';
        if (!$response) {
            $error_message = "Incorrect username or password";
        }
        else{
            $_SESSION['admin'] = $response;
            switch($_SESSION['admin'][2]){
                case 'delivery personnel':
                    header('Location: deliveryPersonnel.php'); 
                    break;
            }            
        }
     
        
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Personnel - The Boardwalk Cafe</title>
    <script src="deliveryPersonnel.js"></script>
</head>
<body>
    <?php

      require 'Employee.php';
      require_once 'DBManager.php';
        class DeliveryPersonnel extends Employee {  
            private $employee;
            private $dbmanager;
            protected $conn;
            
              
            function __construct () {  
              $host = 'localhost';
              $username = 'boardwalk_user';
              $password = 'password123';
              $dbname = 'cafeInfo';
              
              $this->dbmanager = new DBManager($host, $username, $password, $dbname);
              $this->conn = $this->dbmanager->getConn();
              
            }  

            function updateStatus($orderId){
          
                $stmt = $this->conn->prepare("UPDATE `orders` SET `delivered` = 'YES' WHERE `id` = :orderId");
                $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
                $stmt->execute();
          }


          public function viewOrders(){      
            $deliveryPersonnel = $_SESSION['admin'][1];
            echo $_SESSION['admin'][1];
            if ($_SESSION['admin'][1] == "Chad Williams"){
              $stmts = $this->conn->query("SELECT * FROM orders WHERE status = 'CLSD' AND delivered = 'NO' AND deliveryPersonnel = 'Chad Williams'");
              $delivery = $stmts->fetchAll();
            }
            elseif ($_SESSION['admin'][1] == "Jason Campbell"){
              $stmts = $this->conn->query("SELECT * FROM orders WHERE status = 'CLSD' AND  delivered = 'NO' AND deliveryPersonnel = 'Jason Campbell'");
              $delivery = $stmts->fetchAll();
            }
           ?>

            <h3>Delivery Location</h3>
            
            <?php foreach($delivery as $deliveryfor):?>

            <div class="ok">
              
              <div id="DeliveryDiv-<?=$deliveryfor["id"]?>">

                  <?php
                  
                  ?>

                  <h4>Customer's Address</h4>
                  <p>Address Line 1: <?=$deliveryfor["address"]?></p>
                    <p class="delAddress">Address Line 2: <?=$deliveryfor["gen_del_location"]?></p>
                    <p class="delID">Customer's Order #: <?=$deliveryfor["id"]?></p>
                    <p class="delPrice">Customer's Total: $<?=$deliveryfor["total"]?>.00</p>
                    <p class="order-statuses">Status: READY></p>
                    <button id="<?=$deliveryfor["id"]?>" class="delivered-order">Mark as Delivered</button>
            </div> 
            <?php endforeach?>
                     
            
            </div> 
            
            
                
        <?php }
    }

    $deliveryPerson = new DeliveryPersonnel();
    $deliveryPerson->viewOrders();
    if (isset($_GET["orderID"])){
        echo $_GET["orderID"];
        $deliveryPerson->updateStatus((int)$_GET["orderID"]);
    }

    
 
    ?>
    
</body>
</html>