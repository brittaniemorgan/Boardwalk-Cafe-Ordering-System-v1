<?php
    require "DBManager.php";

    class AuthAdmin{
        private $host;
        private $username;
        private $password;
        private $dbname;
        private $stmt;
        private $db;
        private $users;
        
        function __construct(){
            $this->host = 'localhost';
            $this->username = 'boardwalk_user';
            $this->password = 'password123';
            $this->dbname = 'cafeInfo';
            
            $this->db = new DBManager($this->host, $this->username, $this->password, $this->dbname);
            $this->stmt = $this->db->getConn()->query("SELECT * FROM users");
            $this->users = $this->stmt->fetchAll();
        }

        function getLogInInfo(){
            return $this->users;
        }

        function checkPassword($username, $password){
            foreach($this->users as $user){
                $hashPass = hash("sha512", $password);
                if (hash_equals($user['password'], $hashPass) && $username==$user["name"]){                
                    return [$user["id"], $user["name"], []];
                }
            }
            return false;
        }

        function verifyAdmin($username, $password){
            $adminStmt = $this->db->getConn()->query("SELECT * FROM adminusers");
            $adminLog = $adminStmt->fetchAll();
            foreach($adminLog as $user){
                $hashPass = hash("sha512", $password);       
                if (hash_equals($user['password'], $hashPass) && $username==$user["name"]){                
                    return [$user["id"], $user["name"], $user["role"]];
                }
            }
            return false;
        }

        function registerNewUser($name, $password){
            echo "hello";
            $hashPass = hash("sha512", $password);
            $this->db->addUser($name, $password);
            return $this->checkPassword($name, $hashPass);
        }
    }
?>