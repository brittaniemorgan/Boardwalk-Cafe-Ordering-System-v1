<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager - The Boardwalk Cafe</title>
    
    <link rel="stylesheet" href="managerPage.css">

</head>
<body>
    <?php
        require_once 'DBManager.php';
        require_once 'Metrics.php';
        require_once 'Manager.php';

        #turn on error reporting
        ini_set('display_errors', 'On');
        error_reporting(E_ALL | E_STRICT);

        #connects to databse
        $host = 'localhost';
        $username = 'boardwalk_user';
        $password = 'password123';
        $dbname = 'cafeInfo';
        
        $db = new DBManager($host, $username, $password, $dbname);
    ?>

    <div id="nav-buttons">
        <a href="#metrics" class="bottomlink">
            <button class="topButton"><img src="images/downarrow.png">Today's Metrics</button>
        </a>

        <a href="#update-menu" class="bottomlink">
            <button class="topButton"><img src="images/downarrow.png">Update Menu</button>
        </a>
    </div>

    <!--View and manage orders-->
    <div id = "view-manage-orders">
        <h2>Manage Orders</h2>
        <?php
            $manager = new Manager($db);  
            $manager->viewOrders();  
        ?>
    </div>

    

    <!--Add to menu-->
    <div id = "update-menu">
        <h2>Update Menu</h2>
        <br><br>
        <h4>Current Items</h4>
        <div id="current-menu">
            <?php
                $results = $db->menuInfo();
                foreach($results as $row): ?>
                    <p id="small-menu"><?=$row['name'].", ".$row['category'] ?></p>
            <?php endforeach ?>
        </div>

        <h4>Add Menu Item</h4>
        <form action="Manager.php" method="post" id="add-form" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input id="name" name="name" type="text" maxlength="50" required placeholder="Item Name">

            <label for="category">Category:</label>
            <input name="category" type="text" maxlength="35" required placeholder="Category">

            <h5>Sizes</h5>
            <label for="medium">Medium</label>
            <input id="medium" name="medium" type="checkbox" checked required>

            <label for="large">Large</label>
            <input id="large" name="large" type="checkbox">

            <label for="medium-price">Medium Price:</label>
            <input name="medium-price" id="medium-price" type="number" maxlength="5" required placeholder="1200">

            <label for="large-price">Large Price:</label>
            <input name="large-price" id="large-price" type="number" maxlength="5" placeholder="1600">

            <label for="menu-item-image">Upload Menu Image:</label>
            <input name="menu-item-image" type="file">

            <input type="submit" name="add-to-menu" value="Add to Menu"></input>
        </form>

        
        <!--Edit menu-->
        <h4>Edit Menu Item</h4>
        <form action="Manager.php" method="post" id="edit-form">
            <label for="name">Name:</label>
            <input id="name" type="text" maxlength="50" required placeholder="Item Name">

            <label>Category:</label>
            <input type="text" maxlength="35" required placeholder="Category">

            <h5>Sizes</h5>
            <label for="medium">Medium</label>
            <input id="medium" type="checkbox" checked>

            <label for="large">Large</label>
            <input id="large" type="checkbox">

            <label for="medium-price">Medium Price:</label>
            <input id="medium-price" type="text" maxlength="5" required placeholder="1200">

            <label for="large-price">Large Price:</label>
            <input id="large-price" type="text" maxlength="5" placeholder="1600">

            <input type="submit" name="edit-menu" value="Edit Item"></input>
        </form>


        <!--Delete from menu-->
        <h4>Delete Menu Item</h4>
        <form action="Manager.php" method="post"id="delete-form">
            <select name="menu-for-del" id="menu-for-del">
                <?php
                    $results = $db->menuInfo();
                    foreach($results as $row): ?>
                        <option value="<?=$row['id']?>"><?=$row['name'].", ".$row['category'] ?></option>
                
                <?php endforeach ?>
            </select>
            <input type="submit" name="del-from-menu" value="Delete Item"></input>
        </form>

        <a href="#" class="toplink">
            <button class="linkButton"><img src="images/toparrow.png">Back to top</button>
        </a>

    </div>

    
    <!--Shows business metrics in the form of a graph-->
    <div id = "metrics">
        <h2>Today's Orders</h2>
        <?php

            $manager->viewMetrics();
            
        ?>
        <a href="#" class="toplink">
            <button class="linkButton"><img src="images/toparrow.png">Back to top</button>
        </a>
    </div>
    
</body>
</html>