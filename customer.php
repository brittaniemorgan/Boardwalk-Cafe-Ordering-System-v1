<?php  
   class Customer {  
      var $cancel;  
      var $account;  
      var $orders;
      var $rewards;
      var $menu;
        
      function Customer__construct ($cancel, $account, $orders, $rewards, $menu) {  
         $this->cancel = $cancel;
         $this->account = $account;
         $this->orders = $orders;
         $this->rewards = $rewards;
         $this->menu = $menu;

      }  

      function get_cancel(){
        return $this->cancel;
      }

      function get_account(){
        return $this->account;
      }

      function get_orders(){
        return $this->orders;
      }

      function get_rewards(){
        return $this->rewards;
      }

      function get_menu(){
        return $this->menu;
      }


      function viewMenu (){

      }

      function placeOrder (){

    }

      function rewards (){

    }

      function cancelOrder (){

    }

      function createAcc (){

    }

      function viewOrders (){

    }
      
   }  
  
?>  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Boardwalk Cafe</title>
</head>
<body>
    <?php
        class Customer extends Person {  
          private $dbmanager;
          protected $conn;
          // var $cancel;  
          // var $account;  
          // var $orders;
          // var $rewards;
          // var $menu;
            
          function Customer__construct ($name, $username, $password, $dbmanager) { 
            $this->$name = $name;
            $this->$username = $username;
            $this->$password = $password;
            $this->dbmanager = $dbmanager;
            $this->conn = $this->dbmanager->getConn(); 
            //  $this->cancel = $cancel;
            //  $this->account = $account;
            //  $this->orders = $orders;
            //  $this->rewards = $rewards;
            //  $this->menu = $menu;
    
          }  


          function viewMenu(){
            $stmt = $this->conn->query("SELECT * FROM `menuItems`");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            foreach($results as $row){
                echo " ".$row['name']." ".$row['category'];
          }
        }


          function viewOrders(){
            $stmt = $this->conn->query("SELECT * FROM `orders` WHERE `status` = 'OPEN'");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            foreach($results as $row){
                echo " ".$row['items']." ".$row['total'];
            }
        }
      }
    ?>
    
</body>
</html>