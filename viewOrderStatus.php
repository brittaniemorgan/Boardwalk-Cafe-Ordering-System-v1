<?php
    require "DBManager.php";
    $host = 'localhost';
    $username = 'boardwalk_user';
    $password = 'password123';
    $dbname = 'cafeInfo';

    $db = new DBManager($this->host, $this->username, $this->password, $this->dbname);
    
    if (isset($_SESSION['user'])):
        $cusID = $_SESSION['user'][0];
        $stmt = $this->db->getConn()->query("SELECT * FROM users WHERE id = $cusID");
        $customer = $this->stmt->fetchAll()[0];
?>