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
    <link rel="stylesheet" href="deliveryPersonnel.css">
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
              $stmt = $this->conn->query("UPDATE `orders` WHERE `gen_del_location`= 'UWI' AND `delivered`
              = 'NO'");
              $stmt->bindParam('NO', $orderId, PDO::PARAM_STR);
              
              if($stmt->execute()) {
                      echo 'Status Updated';
              }else{
                      echo 'Could Not Update Status';
              } 

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

            $stmts = $this->conn->query("SELECT * FROM `orders` WHERE `delivered` = 'NO'");
            $delivery = $stmts->fetchAll();

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
              
              <div class="DeliveryDiv<?=$deliveryfor["id"]?>">

                  <?php
                  // Set session variables
                  $personUWI = $_SESSION["Chad Williams"];
                  $personOutside = $_SESSION["Jason Campbell"];
                  
                  echo "Session variables are set.";
                  ?>

                  <h4>Customer's Address</h4>
                  <p>Address Line 1: <?=$deliveryfor["address"]?></p>
                    <p class="delAddress">Address Line 2: <?=$deliveryfor["gen_del_location"]?></p>
                    <p class="delID">Customer's Order #: <?=$deliveryfor["id"]?></p>
                    <p class="delPrice">Customer's Total: $<?=$deliveryfor["total"]?>.00</p>
                    <p class="order-statuses">Status: <?=$deliveryfor["status"]?></p>
                    <!-- <button id="<?=$deliveryfor["id"]?>" class="delivered-order" onclick= "alert('Order has been delivered')">
                    Mark as Delivered</button> -->
                    <a href="http://localhost/comp2140-project/newPage.html">
                    <button id="<?=$deliveryfor["id"]?>" class="delivered-order">Mark as Delivered</button>
                    </a>
                  <?php endforeach?>
                     
            </div> 
            </div> 
            
            
                
        <?php }
    }

    $deliveryPerson = new DeliveryPersonnel();
    $deliveryPerson->viewOrders();
    
 
    ?>
    
</body>
</html>