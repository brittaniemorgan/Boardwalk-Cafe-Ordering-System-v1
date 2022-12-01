<?php
 
class DBManager{

    private $conn;
    private $host;
    private $username;
    private $password;
    private $dbname;
    

    function __construct($host, $username, $password, $dbname)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

        
        date_default_timezone_set('EST');

        try{
            $this->conn = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->dbname,
                $this->username,
                $this->password
            );
            
        }catch(Exception $e){
            die($e->getMessage());
        }
        
        
    }

    function getConn(){
        return $this->conn;
    }
    #working
    function menuInfo(){
        #get menu items from the database
        $stmt = $this->conn->query("SELECT * FROM menuItems ORDER BY category");
        $results = $stmt->fetchAll();

        return $results;
    }
    #stmt usually doesnt execute when the vallues we are trying to insert bigger than the value defined in the header insql
    #working
    function userInfo($name){
        

        $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `name` = :name");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        
        if($stmt->execute()){


            if($stmt->rowCount() > 0 ){
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                #tester - later delete
                foreach($results as $row){
                    $info = $row;
                    echo $row['name'];
                }
                return $info;
            
            }else{
                return 'user not found';
            }

        }
    }

    
    #working
    function addUser($name, $password){
        
        $already_here = $this->userInfo($name);
        $hashPass = hash("sha512", $password);

        #constraint - choose a suitable size to limit password to to accomadate hash
        
        
        if($already_here === 'user not found'){

            $stmt = $this->conn->prepare("INSERT INTO `users` (`name`, `password`) VALUES (:name, :password)");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashPass, PDO::PARAM_STR);

            if($stmt->execute()){
                echo 'work';
            }else{
                echo 'an error occurred';
            }
            

        }else{
            echo 'someone already has this username';
        }
             
    }

    
    function deleteUser($name){
        
        $stmt = $this->conn->prepare("DELETE FROM `users` WHERE name = :name");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);

        if($stmt->execute()){
            echo 'user deleted';
        }else{
            echo 'error, user not delete';
        }
    }

    
    function orderInfo($orderId){
        
        $stmt = $this->conn->prepare("SELECT * FROM `orders` WHERE `id` = :orderId");
        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);

        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($results as $row){
                    $info = $row['items'];
                }
                
                return $info;

            }else{
                return 'couldnt find order';
            }

        }else{
            return 'an error';
        }

        #select last order - might need
        #$stmt = $this->conn->prepare("SELECT id FROM orders ORDER BY :id DESC LIMIT 1");
    }

    
   
    function addOrder($total, $items, $genLocation, $address){

        $date = date('d/M/Y');
        $start_time = date('h:i a');
        

        $stmt = $this->conn->prepare("INSERT INTO `orders` (`total`, `items`, `date`, `gen_del_location`, `address`, `start_time`) VALUES (:total, :items, :date, :genLocation, :address, :start_time)");
        $stmt->bindParam(':total', $total, PDO::PARAM_INT);
        $stmt->bindParam(':items', $items, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':genLocation', $genLocation, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':start_time', $start_time, PDO::PARAM_STR);

        if($stmt->execute()){
            echo 'order placed';
        }else{
            echo 'error, couldnt place order';
        }

    }

    
    function deleteOrder($orderId){
        $stmt = $this->conn->prepare("DELETE FROM `orders` WHERE `id` = :orderId");
        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_STR);

        if($stmt->execute()){
            echo 'order deleted';
        }else{
            echo 'error, order deleted';
        }

    }





}


?>