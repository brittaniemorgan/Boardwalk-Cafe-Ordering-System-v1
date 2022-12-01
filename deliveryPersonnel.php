<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Personnel - The Boardwalk Cafe</title>
</head>
<body>
    <?php

      require 'Employee.php';
      require_once 'DBManager.php';
      echo "helo";
        class DeliveryPersonnel extends Employee {  
            // var $status;  
            // var $view;  
            private $employee;
            private $dbmanager;
            protected $conn;
            
              
            function DeliveryPersonnel__construct ($employee, $dbmanager) {  
              $this->dbmanager = $dbmanager;
              $this->employee = $employee;
              $this->conn = $this->dbmanager->getConn();
              
              // $this->status = $status;
              // $this->view = $view;
            }  

            function updateStatus($orderId){
          
              $stmt = $this->conn->prepare("UPDATE `orders` SET `status` = 'CLSD' WHERE `id` = :orderId");
              $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
              
              if($stmt->execute()){
                      echo 'Status Updated';
              }else{
                      echo 'Could Not Update Status';
              }      
          }


          function viewOrders() {
              $stmt = $this->conn->query("SELECT * FROM `orders` WHERE `status` = 'OPEN'");
              $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

              foreach($results as $row){
                  echo " ".$row['items']." ".$row['address']." ".$row['total'];
              }
          }


            
          //   function get_status(){
          //     return $this->status;
          //   }

          //   function get_view(){
          //     return $this->view;
          //   }


          //   function updateStatus (){

          // } 
            
        } 

        
    ?>
    
</body>
</html>