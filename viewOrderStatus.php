<?php
    require "DBManager.php";
    $host = 'localhost';
    $username = 'boardwalk_user';
    $password = 'password123';
    $dbname = 'cafeInfo';

    $db = new DBManager($host, $username, $password, $dbname);
    
    if (isset($_SESSION['user'])){
        $cusID = $_SESSION['user'][0];
        $stmt = $db->getConn()->query("SELECT * FROM users WHERE id = $cusID");
        $customer = $stmt->fetchAll()[0];
    }
?>