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

        function getLogInInfo(){
            return $this->logInInfo;
        }

        function checkPassword($username, $password){
            foreach($this->logInInfo as $info){
                $hashPass = hash("sha512", $password);
                if (hash_equals($info['password'], $hashPass) && $username==$info["name"]){                
                    return [$info["id"], $info["name"], []];
                }
            }
            return false;
        }

        function verifyAdmin($username, $password){
            $adminStmt = $this->db->getConn()->query("SELECT * FROM adminusers");
            $adminLog = $adminStmt->fetchAll();
            foreach($adminLog as $info){
                if([$username,$password]==[$info["name"], $info["password"]]){      //use hash
                    echo "hello";       
                    return [$info["id"], $info["name"], $info["role"]];
                }             
            }
            return false;
        }

        function registerNewUser($name, $password){
            echo "hello";
            $this->db->addUser($name, $password);
            //return [$info["id"], $info["name"], []];
        }
    }

    //$admin = new AuthAdmin();
    //$admin->verifyAdmin("hd",120);
?>