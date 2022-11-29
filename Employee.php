<?php
header('Access-Control-Allow-Origin: *');
require_once 'DBManager.php';
require "Person.php";
    
class Employee extends Person{

    #connects to databse
    private $dbmanager;
    protected $conn;

    function __construct($name, $username, $password,$dbmanager)
    {
        $this->$name = $name;
        $this->$username = $username;
        $this->$password = $password;
        $this->dbmanager = $dbmanager;
        $this->conn = $this->dbmanager->getConn();
    }

    #server
    function updateStatus($orderId){
    
        $stmt = $this->conn->prepare("UPDATE `orders` SET `status` = 'CLSD' WHERE `id` = :orderId");
        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        
        if($stmt->execute()){
                echo 'status updated';
        }else{
                echo 'couldnt updated status';
        }
       
       
    }

    function delUpdateStatus($orderId){
       
        $stmt = $this->conn->prepare("UPDATE `orders` SET `delivered` = 'YES' WHERE `id` = :orderId");
        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        
        if($stmt->execute()){
                echo 'status updated';
        }else{
                echo 'couldnt updated status';
        }
       
       
    }

    #both methods can implement in classes
    #server view open order
    function viewOrders(){
        $stmt = $this->conn->query("SELECT * FROM `orders` WHERE `status` = 'OPEN'");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($results as $row){
            echo " ".$row['items']." ".$row['total'];
        }
    }

    #delivery view not delivered order
    function delViewOrders(){
        $stmt = $this->conn->query("SELECT * FROM `orders` WHERE `delivered` = 'NO'");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($results as $row){
            echo " ".$row['items']." ".$row['total'];
        }
    }
}
?>