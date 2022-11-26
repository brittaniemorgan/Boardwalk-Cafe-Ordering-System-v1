<?php

    #create database query
    class Manager extends Employee{
        
        public function __construct(){}
        
        public function viewMetrics(){}

        public function addMenuItem($foodID, $database){}

        public function deleteMenuItem($foodID, $database){}

        public function editMenuItems($foodID, $database){}

        public function viewOrders(){}
    }

    class RequestManager{
        public function sanitizeInput($text){
            return htmlentities($text);
        }

        public function receiveData(){}
        public function validateForm(){}
    }
?>