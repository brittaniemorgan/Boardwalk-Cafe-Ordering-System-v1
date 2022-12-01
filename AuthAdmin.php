<?php
    require "DBManager.php";

    class AuthAdmin{
        private $host;
        private $username;
        private $password;
        private $dbname;
        private $stmt;
        private $db;
        private $logInInfo;
        
        function __construct(){
            $this->host = 'localhost';
            $this->username = 'boardwalk_user';
            $this->password = 'password123';
            $this->dbname = 'cafeInfo';
            
            $this->db = new DBManager($this->host, $this->username, $this->password, $this->dbname);
            $this->stmt = $this->db->getConn()->query("SELECT * FROM users");
            $this->logInInfo = $this->stmt->fetchAll();
        }

        function getPasswords(){
            return $this->logInInfo;
        }

        function checkPassword($username, $password){

        }
    }
    $admin = new AuthAdmin();
    echo $admin->getPasswords();
?>