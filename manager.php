<?php

require_once 'DBManager.php';
require_once 'Metrics.php';

class Manager{
    
    private $conn;
    private $metrics;

    function __construct($dbmanager){

        $this->conn = $dbmanager->getConn();
        $this->metrics = new Metrics($dbmanager);
        
    }

    function viewMetrics(){
        
        $this->metrics->generateReport();
    }

    function addMenuItem(){
        
        #gets the menu items name, category, medium price, etc.
        $name = $_POST['name'];
        $category = $_POST['category'];
        $medium_price = $_POST['medium-price'];

        if(isset($_POST['large']) and $_POST['large-price'] === ""){
            $lrg = "";
            $lrg_price = 0;
        }elseif(isset($_POST['large'])){
            $lrg = "LRG";
            $lrg_price = intval($_POST['large-price']);
        }else{
            $lrg = "";
            $lrg_price = 0;
        }

        #checks if an image was uploaded, uploades the image to the images folder and saves the path in the database.
        if(array_key_exists('menu-item-image', $_FILES)){

            $allowedExtensions = ['png', 'jpg', 'jpeg'];
            $imgName = $_FILES['menu-item-image']['name'];

            $imgExtension = pathinfo($imgName, PATHINFO_EXTENSION);
    
            #check that its an image file
            if(in_array(strtolower($imgExtension), $allowedExtensions)){
                
                $stmt = $this->conn->prepare("INSERT into menuItems (image, `name`, `category`, `price`, `large_size`, `large_price`) VALUES (:imgName, :name, :category, :price, :large_size, :large_price)");
                $stmt->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':category', $category, PDO::PARAM_STR);
                $stmt->bindParam(':price', $medium_price, PDO::PARAM_INT);
                $stmt->bindParam(':large_size', $lrg, PDO::PARAM_STR);
                $stmt->bindParam(':large_price', $lrg_price, PDO::PARAM_INT);

                if($stmt->execute()){
                    move_uploaded_file($_FILES['menu-item-image']['tmp_name'], "images/$imgName");
                    echo "<script>alert('sent to folder')</script>";
                    header("location: managerPage.php");

                }
                
                
                #delete file from folder
                #unlink("images/$imgName");
                #echo "<script>alert('file deleted')</script>";
            }else{
                echo "File should be a png, jpg or jpeg";
            }
        
        #if an image wasnt uploaded this will be done instead
        }else{
            echo "File was too large to upload";
            $stmt = $this->conn->prepare("INSERT INTO `menuItems` (`name`, `category`, `price`, `large_size`, `large_price`) VALUES (:name, :category, :price, :large_size, :large_price)");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':category', $category, PDO::PARAM_STR);
            $stmt->bindParam(':price', $medium_price, PDO::PARAM_INT);
            $stmt->bindParam(':large_size', $lrg, PDO::PARAM_STR);
            $stmt->bindParam(':large_price', $lrg_price, PDO::PARAM_INT);
            
            if($stmt->execute()){

                #reload the page
                header("location: managerPage.php");

            }else{
                echo 'An error has occurred';
            }
        }
        
    }

    function deleteMenuItem(){
        #get the id of item to be deleted
        $id = $_POST['menu-for-del'];

        $stmt =$this->conn->prepare("DELETE FROM `menuItems` WHERE `id` = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'item deleted';
        }else{
            echo 'an error occurred';
        }
    }

    function editMenuItem(){

    }

    function viewOrders(){
        $stmt = $this->conn->query("SELECT * FROM `orders` WHERE `status` = 'OPEN'");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($results as $row){
            echo " ".$row['items']." ".$row['total'];
        }

    }

}

#connects to databse
$host = 'localhost';
$username = 'boardwalk_user';
$password = 'password123';
$dbname = 'cafeInfo';

$db = new DBManager($host, $username, $password, $dbname);
$manager = new Manager($db);

if(isset($_POST['add-to-menu'])){
    $manager->addMenuItem();
}elseif(isset($_POST['del-from-menu'])){
    $manager->deleteMenuItem();
}
