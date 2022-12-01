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
    <script src="script.js"></script>
</head>
<body>
    <?php

      require 'Employee.php';
      require_once 'DBManager.php';
        class DeliveryPersonnel extends Employee {  
            // var $status;  
            // var $view;  
            private $employee;
            private $dbmanager;
            protected $conn;
            
              
            function __construct () {  
             # $this->dbmanager = $dbmanager;
              #$this->employee = $employee;
              $host = 'localhost';
              $username = 'boardwalk_user';
              $password = 'password123';
              $dbname = 'cafeInfo';
              
              $this->dbmanager = new DBManager($host, $username, $password, $dbname);
              $this->conn = $this->dbmanager->getConn();
              
              // $this->status = $status;
              // $this->view = $view;
            }  

            function updateStatus($orderId){
          
              // $stmt = $this->conn->prepare("UPDATE `orders` SET `status` = 'CLSD' WHERE `id` = :orderId");
              // $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
              
              // if($stmt->execute()){
              //         echo 'Status Updated';
              // }else{
              //         echo 'Could Not Update Status';
              // } 
             /* $stmt = $this->conn->query("UPDATE `orders` SET WHERE `gen_del_location`= 'UWI' AND `delivered`
              = 'NO'");
              $stmt->bindParam('NO', $orderId, PDO::PARAM_STR);
              
              if($stmt->execute()) {
                      echo 'Status Updated';
              }else{
                      echo 'Could Not Update Status';
              } */
                $stmt = $this->conn->prepare("UPDATE `orders` SET `delivered` = 'YES' WHERE `id` = :orderId");
                //UPDATE `orders` SET `status` = 'CLSD', `end_time` = "90" WHERE `id` = 4;
                $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
          }


          // function viewOrdersold() {
          //     $stmt = $this->conn->query("SELECT * FROM `orders` WHERE `status` = 'OPEN'");
          //     $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

          //     foreach($results as $row){
          //         echo " ".$row['items']." ".$row['address']." ".$row['total'];
          //     }
          // }


          public function viewOrders(){          
            // $stmt = $this->conn->query("SELECT * FROM `orders` WHERE `status` = 'OPEN'");
            // $orders = $stmt->fetchAll();
            $deliveryPersonnel = $_SESSION['admin'][1];
            echo $_SESSION['admin'][1];
            if ($_SESSION['admin'][1] == "Chad Williams"){
              $stmts = $this->conn->query("SELECT * FROM orders WHERE delivered = 'NO' AND deliveryPersonnel = 'Chad Williams'");
              $delivery = $stmts->fetchAll();
            }
            elseif ($_SESSION['admin'][1] == "Jason Campbell"){
              $stmts = $this->conn->query("SELECT * FROM orders WHERE delivered = 'NO' AND deliveryPersonnel = 'Jason Campbell'");
              $delivery = $stmts->fetchAll();
            }
            /*$stmts = $this->conn->prepare("SELECT * FROM `orders` WHERE `delivered` = 'NO' AND `deliveryPersonnel` = :deliveryPersonnel");
            $stmts->bindParam(':deliveryPersonnel', $deliveryPersonnel, PDO::PARAM_STR);
            $delivery = $stmts->fetchAll(PDO::FETCH_ASSOC);
            */

            $del = $this->conn->query("SELECT * FROM orders WHERE `delivered` = 'NO' AND 
            `deliveryPersonnel` = 'Chad Williams'");
            $delUWI = $del->fetchAll();

            $del = $this->conn->query("SELECT * FROM orders WHERE `delivered` = 'NO' AND 
            `deliveryPersonnel` = 'Jason Campbell'");
            $delOut = $del->fetchAll();
           ?>

            <!-- <?php
            // Set session variables
            $_SESSION["favcolor"] = "green";
            $_SESSION["favanimal"] = "cat";
            echo "Session variables are set.";
            ?> -->


            <h3>Delivery Location</h3>
            
            <?php foreach($delivery as $deliveryfor):?>

            <div class="ok">
              
              <div id="DeliveryDiv-<?=$deliveryfor["id"]?>">

                  <?php
                  // Set session variables
                  $personUWI = "Chad Williams";
                  $personOutside = "Jason Campbell";
                  
                  ?>

                  <h4>Customer's Address</h4>
                  <p>Address Line 1: <?=$deliveryfor["address"]?></p>
                    <p class="delAddress">Address Line 2: <?=$deliveryfor["gen_del_location"]?></p>
                    <p class="delID">Customer's Order #: <?=$deliveryfor["id"]?></p>
                    <p class="delPrice">Customer's Total: $<?=$deliveryfor["total"]?>.00</p>
                    <p class="order-statuses">Status: <?=$deliveryfor["status"]?></p>
                    <!-- <button id="<?=$deliveryfor["id"]?>" class="delivered-order" onclick= "alert('Order has been delivered')">
                    Mark as Delivered</button> -->
                    <button id="<?=$deliveryfor["id"]?>" class="delivered-order">Mark as Delivered</button>
            
            <?php endforeach?>
                     
            </div> 
            </div> 
            
            
                
        <?php }
    }

    $deliveryPerson = new DeliveryPersonnel();
    $deliveryPerson->viewOrders();
    if (isset($_GET["orderID"])){
        echo $_GET["orderID"];
        $deliveryPerson->updateStatus($_GET["orderID"]);
    }

    
 
    ?>
    
</body>
</html>