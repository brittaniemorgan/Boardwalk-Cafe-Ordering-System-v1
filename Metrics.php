<?php

require_once 'DBManager.php';

#view average time for order, days earnings 

class Metrics{

    private $conn;

    function __construct($dbmanager)
    {
        $this->conn = $dbmanager->getConn();
        
    }

    function retrieveDB(){

        return 0;
    }

    function generateReport(){

    }
}

?>