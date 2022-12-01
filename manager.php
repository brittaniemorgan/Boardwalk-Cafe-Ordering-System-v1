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
        if(array_key_exists('menu-item-image', $_FILES) and $_FILES['menu-item-image']['error'] != UPLOAD_ERR_NO_FILE){

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
                    echo '<script>alert("Item added")</script>';
                    echo("<script>window.location = 'managerPage.php';</script>");

                }
                
            }else{
                echo "File should be a png, jpg or jpeg";
            }
        
        #if an image wasnt uploaded this will be done instead
        }else{
            
            $stmt = $this->conn->prepare("INSERT INTO `menuItems` (`name`, `category`, `price`, `large_size`, `large_price`) VALUES (:name, :category, :price, :large_size, :large_price)");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':category', $category, PDO::PARAM_STR);
            $stmt->bindParam(':price', $medium_price, PDO::PARAM_INT);
            $stmt->bindParam(':large_size', $lrg, PDO::PARAM_STR);
            $stmt->bindParam(':large_price', $lrg_price, PDO::PARAM_INT);
            
            if($stmt->execute()){

                #output message, reload the page
                echo '<script>alert("Item added")</script>';
                echo("<script>window.location = 'managerPage.php';</script>");
                #header("location: managerPage.php");
                

            }else{
                echo 'An error has occurred';
            }
        }
        
    }

    function deleteMenuItem(){
        #get the id of item to be deleted
        $id = $_POST['menu-for-del'];

        $stmt =$this->conn->prepare("SELECT `image` FROM `menuItems` WHERE `id` = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            #checks if the items image is the default image, ensures we dont delete default image
            if($results[0]['image'] != "default-menu-image.jpg"){
                $stmt =$this->conn->prepare("DELETE FROM `menuItems` WHERE `id` = :id");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                if($stmt->execute()){

                    #deletes item image from folder
                    unlink("images/".$results[0]['image']);

                    echo '<script>alert("Item Deleted")</script>';
                    echo("<script>window.location = 'managerPage.php';</script>");
                }else{
                    echo 'an error occurred';
                }
            }else{
                $stmt =$this->conn->prepare("DELETE FROM `menuItems` WHERE `id` = :id");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                if($stmt->execute()){

                    echo '<script>alert("Item Deleted")</script>';
                    echo("<script>window.location = 'managerPage.php';</script>");
                }else{
                    echo 'an error occurred';
                }
                
            }
            
        }
        
    }

    function editMenuItem(){
        #get the id of item to be edited
        $id = $_POST['menu-for-edit'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['medium-price'];

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
        
        $stmt =$this->conn->prepare("UPDATE `menuItems` SET `name` = :name, `category` = :category, `price` = :price, `large_price` = :lrg_price, `large_size` = :lrg_size  WHERE `id` = :id");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':lrg_size', $lrg, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':lrg_price', $lrg_price, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if($stmt->execute()){
            echo '<script>alert("Item Updated")</script>';
            echo("<script>window.location = 'managerPage.php';</script>");
        }else{
            echo 'Couldnt update item';
        }
    }

    function outOfStock(){
        $id = $_POST['menu-for-out'];

        $stmt =$this->conn->prepare("UPDATE `menuItems` SET `in_stock` = 'NO' WHERE `id` = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if($stmt->execute()){
            echo '<script>alert("Item Put Out of Stock")</script>';
            echo("<script>window.location = 'managerPage.php';</script>");
        }else{
            echo 'Unable to put item out of stock';
        }

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
}elseif(isset($_POST['edit-menu'])){
    $manager->editMenuItem();
}elseif(isset($_POST['out-from-menu'])){
    $manager->outOfStock();
}
