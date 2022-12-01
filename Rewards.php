<?php


session_start();


// #connects to databse
// $host = 'localhost';
// $username = 'boardwalk_user';
// $password = 'password123';
// $dbname = 'cafeInfo';

// $db = new DBManager($host, $username, $password, $dbname);

class Rewards{

    private $db;
    private $conn;

    function __construct($db)
    {
        $this->db = $db;
        $this->conn = $db->getConn();

        
    }

    function retrieveRewardsData(){
        $user = $_SESSION['username'];
        $info = $this->db->userInfo($user);
        $points = $info['reward points'];
        

        return $points;
    }

    function applyPoints(){
        $user = $_SESSION['username'];
        $info = $this->db->userInfo($user);
        $points = $info['reward points'];
        
    }

    function calRewards(){

    }

    function expirePoints(){
        $this->conn->query("UPDATE `users` SET `reward points` = 0");
    }

}

?>