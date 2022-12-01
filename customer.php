<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="MenuItem.js"></script>
    <title>The Boardwalk Cafe</title>
</head>
<body>
    <?php
        require "DBManager.php";
        // require "index.php";
        
        class Customer extends Person {  
          private $dbmanager;
          protected $conn;
            
          function Customer__construct ($name, $username, $password, $dbmanager) { 
            $this->$name = $name;
            $this->$username = $username;
            $this->$password = $password;
            $this->dbmanager = $dbmanager;
            $this->conn = $this->dbmanager->getConn(); 
            
          }  


          function viewMenuold(){
            $stmt = $this->conn->query("SELECT * FROM `menuItems`");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            foreach($results as $row){
                echo " ".$row['name']." ".$row['category'];
          }
        }


          function viewOrdersold(){
            $stmt = $this->conn->query("SELECT * FROM `orders` WHERE `status` = 'OPEN'");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            foreach($results as $row){
                echo " ".$row['items']." ".$row['total'];
            }
        }



// New Section

      public function viewOrders(){
          $stmt = $this->conn->query("SELECT * FROM `menuItems`");
          $orders = $stmt->fetchAll();
         ?>
          <h2>Menu</h2>
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
                    
                        <li id="<?=$order["id"]?>>"><?=$foodName?>, <?=substr($item,3)?></li>
                        <p class="item-category">Category: <?=$foodCategory?></p>
                    <?php endforeach?>
                </ul>
                <p class="order-status">Status: <?=$order["status"]?></p>
                <button id="<?=$order["id"]?>" class="mark-preparing">Mark as Preparing</button>
                <button id="<?=$order["id"]?>" class="mark-ready">Mark as Ready</button>
            </div>
            <?php endforeach?>
            <?php }  
            
            

            
            public function viewMenu(){
              $stmt = $this->conn->query("SELECT * FROM `menuItems`");
              $menu = $stmt->fetchAll();
             ?>
              <h2>Menu</h2>
              <?php foreach($menu as $menuSel):?>
                <div id="menuDiv<?=$menuSel["id"]?>">
                  <h3>Category <?=$menuSel["category"]?></h3>
                  <ul><?php
                    $menuItems = explode(",",$menuSel["category"]);
                    foreach($menuItems as $itemsOnMenu):
                      $menuID = (int) substr($itemsOnMenu, 0, 2);
                      $menuItemss = $this->conn->query("SELECT * FROM menuItems WHERE id =$menuID");
                      $menuResult = $menuItemss->fetchAll();
                      $menuName = $menuResult[0]["name"];
                      $menuCategory = $menuResult[0]["category"];
                      ?>  

                    <li id="<?=$order["id"]?>>"><?=$foodName?>, <?=substr($item,3)?></li>
                    <?php endforeach?>
                  </ul>  
                  

                <p class="delAddress">Menu <?=$menuName?></p>
                <p class="delAddress">Categories <?=$menuCategory?></p>
                <!-- <p class="delID">Customer's Order #: <?=$delOrderID?></p>
                <p class="delPrice">Customer's Total: <?=$delOrderPrice?></p> -->
            </div> 
            <?php endforeach?>
            
            
            <?php  }

      }

      public function placeOrder(){

      }


      public function cancelOrder(){
        
      }


      public function createAcc(){
        
      }

      public function rewards(){
        
      }

     
    $customers = new customer();
    $customers->viewMenu();

    ?>
    
</body>
</html>