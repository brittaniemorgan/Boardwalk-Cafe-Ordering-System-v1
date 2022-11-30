<?php



require "DBManager.php";
$host = 'localhost';
$username = 'boardwalk_user';
$password = 'password123';
$dbname = 'cafeInfo';
$db = new DBManager($host, $username, $password, $dbname);
$conn = $db -> getConn();

$items = [];
class OrderProcessing{}
$foodID = $_POST["foodID"];
$stmt = $conn->query("SELECT * FROM menuItems WHERE id = $foodID");

$results = $stmt->fetchAll();
$name =$results[0]["name"];
$price = $results[1]["price"];
$size = $_POST["mealSize"];
if (isset($_POST["side"])){
    $side = $_POST["side"];
}
else{
    $side = "";
}

$comments = $_POST["comments"];

array_push($items, [$name,$size,1, $price, $comments]); #work on getting quantity

addOrder($total, $items, $genLocation, $address)




class OrderProcessor1 {

    function __construct($orderlist) {  // Constructor
      $this->$orderlist = $orderlist;
      
    }

    function organizeDeliveryLocation($listoforders){
        function compare($order1, $order2) {
            if ($order1.address < $order2.address)
               return -1;
            if ($order1.address > $order2.address)
              return 1;
            return 0;
          }
          

        //sort list of deliveries
        //delivlist = 

        $delivlist.sort(compare);
        
    }

    function assignDeliveries($order){
        //add the order to the dictionary of deliveries
        $delivdict = {}; //dict of delivery pesonell
        for ($i of $delivdict){
            if ($delivdict[i] = ""){
                $delivdict[i] = $order;
            }
        }
            
                
    }

    function uploadOrder(){
        $Btn1 = document.querySelector("button-checkout");
        $orderBtn = Btn1[0];

        //[$name,$size,1, $price, $comments]

        orderBtn.addEventListener("click", function(){
            var foodID = 
            addOrder($total, $items, $genLocation, $address)
                })
                .catch(error => {
                    console.log(error);
                });
        });

        addOrder($total, $items, $genLocation, $address)
    }
            




   
    orderlst = [];

    saveOrder(){
        $saveOrderBtn = document.getElementById("addToCart");
        saveOrderBtn.addEventListener("click", function(){
            $orderitem1 = document.getElementById("order").value;

            $orderlst = $orderlst +[$orderitem1]


            
             


            // orderitem2 = document.getElementById("").value;
            // quantity2 = document.getElementById("").value;

            $newOrder = new Order($orderlst,$address);
            //INSERT INTO table1 (column1, column2,...) VALUES (value1, value2,...);
        });
    }

    viewCart(){
        $viewCartBtn = document.getElementById("addToCart");
        viwCartBtn.addEventListener("click", function(){
            $itemdisplay = document.getElementsByClassName("items").value;

            $items = $itemdisplay[0];
            items.innerHTML = $orderlst;


            
        });
    }

    removeOrder($orderlist){
        removeOrderBtn.addEventListener("click", function(){
            $orderitem = document.getElementById("").value;
        });
        for (var i = 0; i < orderlist.length; i++){
            if ($orderitem.orderNum == $orderlist.orderNum){
                orderlist.splice(i, 1);
            }
        }

    }

  }