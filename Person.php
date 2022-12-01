<?php
    class Person {
        private $name;
        private $username;
        private $password;  
        function __construct($name, $username, $password) { 
          $this->$name = $name;
          $this->$username = $username;
          $this->$password = $password;
        }
    
        public function getName(){
            return $this->name;
        }
    
        public function getUsername(){
            return $this->username;
        }
    
        public function getPassword(){
            return $this->password;
        }
    }
 
?>