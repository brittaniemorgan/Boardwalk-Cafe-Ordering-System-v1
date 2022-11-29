<?php
    require_once 'DBManager.php';
    $foodID = $_GET["foodID"];
    $host = 'localhost';
    $username = 'boardwalk_user';
    $password = 'password123';
    $dbname = 'cafeInfo';
    
    $db = new DBManager($host, $username, $password, $dbname);

    $db -> getFoodDescription($foodID);
?>
