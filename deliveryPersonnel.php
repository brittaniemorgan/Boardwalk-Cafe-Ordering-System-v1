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
            $stmt = $this->conn->query("SELECT * FROM `orders` WHERE `status` = 'OPEN'");
            $orders = $stmt->fetchAll();
            $stmts = $this->conn->query("SELECT * FROM `orders` WHERE `delivered` = 'NO'");
            $delivery = $stmts->fetchAll();
           ?>

            <h3>Delivery Location</h3>
            
            <?php foreach($delivery as $deliveryfor):?>
              
              <div id="DeliveryDiv<?=$deliveryfor["id"]?>">
                  <h4>Customer's Address <?=$deliveryfor["address"]?></h4>
                  <ul><?php
                      $deliveryLocate = explode(",",$deliveryfor["address"]);
                      foreach($deliveryLocate as $addresses):
                        // $delID = (int) substr($addresses,0,2);
                        $delLocation = $this->conn->query("SELECT * FROM orders WHERE delivered = 'NO'");
                        $delResult = $delLocation->fetchAll();
                        $delSpecificLocate = $delResult[0]["gen_del_location"];
                        $delGeneralLocate = $delResult[0]["address"];
                      ?>

                <p class="delAddress">Customer's Address: <?=$delSpecificLocate?></p>
                <p class="delAddress">Customer's General Location: <?=$delGeneralLocate?></p> 
              </div> 
            <?php endforeach?>
            <?php endforeach?>


                <!-- <p class="delAddress">Customer's Address: <?=$deliveryfor["address"]?></p>  -->
              <!-- <button id="<?=$order["id"]?>" class="cust-address">See Customer's Address</button> -->
                
        <?php }
    }

    $deliveryPerson = new DeliveryPersonnel();
    $deliveryPerson->viewOrders();
    
 
    ?>
    
</body>
</html>