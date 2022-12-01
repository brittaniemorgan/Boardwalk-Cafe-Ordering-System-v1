<?php

require_once 'DBManager.php';
require_once 'Metrics.php';

class Manager{
    
    private $conn;
    private $metrics;

    function __construct($dbmanager){

        $this->conn = $dbmanager->getConn();
        $this->metrics = new Metrics($dbmanager);
        
    }

    function viewMetrics(){
        
        $this->metrics->generateReport();
    }

    function addMenuItem(){

    }

    function deleteMenuItem(){

    }

    function editMenuItem(){

    }

    function viewOrders(){
        $stmt = $this->conn->query("SELECT * FROM `orders` WHERE `status` = 'OPEN'");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($results as $row){
            echo " ".$row['items']." ".$row['total'];
        }

    }


}
