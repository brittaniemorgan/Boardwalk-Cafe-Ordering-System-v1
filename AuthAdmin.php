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
                if([$username,$password]==[$info["name"], $info["password"]]){
                    return [$info["id"], $info["name"]];
                }
                else{
                    return false;
                }
            }
        }

        function grantMenuAcess(){
            if (isset($_POST["username"]) && $_POST["password"]){
                if ($this->checkPassword($_POST["username"], $_POST["password"])){
                    echo "Go ahead";
                }

                else{
                    echo "Try again";
                }
            }
        }
    }
    $admin = new AuthAdmin();
    //$admin->grantMenuAcess();
?>