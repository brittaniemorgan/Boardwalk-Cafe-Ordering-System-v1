<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

#connects to databse
$host = 'localhost';
$username = 'boardwalk_user';
$password = 'password123';
$dbname = 'cafeInfo';
            
try {

    $conn = new PDO('mysql:host=' . $host . ';dbname=' . $dbname,$username,$password);
    
    if(array_key_exists('menu-item-image', $_FILES)){

        $allowedExtensions = ['png', 'jpg', 'jpeg'];
        $imgName = $_FILES['menu-item-image']['name'];
        $imgExtension = pathinfo($imgName, PATHINFO_EXTENSION);

        #check that its an image file
        if(in_array(strtolower($imgExtension), $allowedExtensions)){
            #$imgName = 'g';
            $stmt = $conn->query("INSERT into menuItems (image) VALUES ($imgName)");
   
            move_uploaded_file($_FILES['menu-item-image']['tmp_name'], "images/$imgName");
            echo "<script>alert('sent to folder')</script>";
            
            #delete file from folder
            #unlink("images/$imgName");
            #echo "<script>alert('file deleted')</script>";
        }else{
            echo "File should be a png, jpg or jpeg";
        }
        
    }else{
        echo "File was too large to upload";
    }
    

    #unlink deletes image


   

} catch (Exception $e) {
    die($e->getMessage());

}
?>