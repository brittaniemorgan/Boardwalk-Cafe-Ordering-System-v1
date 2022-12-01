<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place an Order With Us</title>

    <link rel="stylesheet" href="index.css">
    <script src="script.js" type="text/javascript"></script>
</head>
<body>

    <div id="overLay">
        <div id="popUp">
            <div id="item-description"></div>
            <button id="close-btn"> Close</button>
        </div>
    </div>

        <header>
            <span id="expandBtn" style="font-size:30px;cursor:pointer;color:white;" >&#9776;</span>
            <img src="images/boardWalkLogo.png" alt="boardwalk cafe's logo" id="boardwalkHeaderLogo">
    
            <br>
            <br>
            <h4 id="boardwalk-cafe">Boardwalk Caf&eacute;</h4>
            <div id="wrapper">
            <div id="myNav" class="overlay">

                <!-- Button to close the overlay navigation -->
                <a href="javascript:void(0)" id="close-menu-btn" >&times;</a>
                
                <!-- Overlay content -->
                <div class="overlay-content">
                <a href="index.php">Home</a>
                <a href="#">Previous Orders</a>
                <a href="#">Log Out</a>
                <a href="#">Contact</a>
                <a href="adminLogIn.php">Admin</a>
                </div>

            </div>

            <div id="contact-and-welcome">
                <h5>876-977-6205</h2>  
                <h1>WEL</h1><br><h1>COME!</h1>
            </div>          
            
        </header>

       
        <section id="menu-wrapper">
            <div id="menu-heading-wrapper">
                <h2>Menu</h2>
                <img src="images/menu-icon.png">
            </div>
        
            
            <div id="menu-items-wrapper">
                

                <?php
                    #$_SESSION["user"] = "user123";
                    require_once 'DBManager.php';
                    

                    #turn on error reporting
                    ini_set('display_errors', 'On');
                    error_reporting(E_ALL | E_STRICT);

                    #connects to databse
                    $host = 'localhost';
                    $username = 'boardwalk_user';
                    $password = 'password123';
                    $dbname = 'cafeInfo';
                    
                    $db = new DBManager($host, $username, $password, $dbname);
                    
                    #goes through each menu item and prints its data
                    $results = $db->menuInfo();?>
                    <!--?><div>
            
        <?php
            #iterates through each row of the data base
            for ($x = 0; $x < count($results); $x++){ 


                #prints item category when item is the first one in the category       
                if($x > 0 and $results[$x-1]['category'] != $results[$x]['category']){?>
                    <h3 class="category-heading"><?=$results[$x]['category']?></h3>
                <?php }elseif($x === 0){?>
                    <h3 class="category-heading"><?=$results[$x]['category']?></h3>
                <?php } ?>
                        
                
                <button class="addToOrderButton" id="<?=$results[$x]["id"]?>">
                    <div class="menuItem" id="<?=$results[$x]["id"]?>">
                        <img src=<?="images/".$results[$x]['image']?> class="menuItemPic" itemid="<?=$results[$x]["id"]?>">

                        <div class="menuItemContent"  itemid="<?=$results[$x]["id"]?>">
                            
                            <h5 itemid="<?=$results[$x]["id"]?>"><?=$results[$x]['name']?></h5>
                            <div class="prices" itemid="<?=$results[$x]["id"]?>">
                                <?php 
                                    #checks if the item comes in a large size and prints the large size value
                                    if(intval($results[$x]['large_price']) > 0 and intval($results[$x]['price']) > 0){?>
                                            
                                        <h6 itemid="<?=$results[$x]["id"]?>"><?=$results[$x]['medium_size']?> - $<?=$results[$x]['price']?></h6>
                                        <h6 itemid="<?=$results[$x]["id"]?>"><?=$results[$x]['large_size']?> - $<?=$results[$x]['large_price']?></h6>
                                            
                                            
                                    <?php }elseif(intval($results[$x]['price']) > 0){?>
                                             
                                        <h6 itemid="<?=$results[$x]["id"]?>">Price - $<?=$results[$x]['price']?></h6>
                                    <?php } ?>       
                                                 
                                    
                                </div>
                        </div>
                    </div>
                </button>
                        
                    <?php } ?>
        </div>-->
                    <div>
            
                    <?php
                        #iterates through each row of the data base
                        for ($x = 0; $x < count($results); $x++){ 
                            if(1===2){
                                #prints item category when item is the first one in the category       
                                if($x > 0 and $results[$x-1]['category'] != $results[$x]['category']){?>
                                    <h3 class="category-heading"><?=$results[$x]['category']?></h3>
                                <?php }elseif($x === 0){?>
                                    <h3 class="category-heading"><?=$results[$x]['category']?></h3>
                                <?php } ?>
                                        
                                
                                <button class="addToOrderButton" onclick="alert('naurr');">
                                    <div class="menuItem">
                                        <img src=<?="images/".$results[$x]['image']?> class="menuItemPic">
                            
                                        <div class="menuItemContent">
                                            
                                            <h5><?=$results[$x]['name']?></h5>
                                            <div class="prices">
                                                <?php 
                                                    #checks if the item comes in a large size and prints the large size value
                                                    if(intval($results[$x]['large_price']) > 0 and intval($results[$x]['price']) > 0){?>
                                                            
                                                        <h6><?=$results[$x]['medium_size']?> - $<?=$results[$x]['price']?></h6>
                                                        <h6><?=$results[$x]['large_size']?> - $<?=$results[$x]['large_price']?></h6>
                                                            
                                                            
                                                    <?php }elseif(intval($results[$x]['price']) > 0){?>
                                                            
                                                        <h6>Price - $<?=$results[$x]['price']?></h6>
                                                    <?php } ?>       
                                                                
                                                    
                                                </div>
                                        </div>
                                    </div>
                                </button>

                            <?php }else{

                            #prints item category when item is the first one in the category       
                            if($x > 0 and $results[$x-1]['category'] != $results[$x]['category']){?>
                                <h3 class="category-heading"><?=$results[$x]['category']?></h3>
                            <?php }elseif($x === 0){?>
                                <h3 class="category-heading"><?=$results[$x]['category']?></h3>
                            <?php } ?>
                                    
                            
                            <button class="addToOrderButton" onclick="alert('naurr');">
                                <div class="menuItem">
                                    <img src=<?="images/".$results[$x]['image']?> class="menuItemPic">
                        
                                    <div class="menuItemContent">
                                        
                                        <h5><?=$results[$x]['name']?></h5>
                                        <div class="prices">
                                            <?php 
                                                #checks if the item comes in a large size and prints the large size value
                                                if(intval($results[$x]['large_price']) > 0 and intval($results[$x]['price']) > 0){?>
                                                        
                                                    <h6><?=$results[$x]['medium_size']?> - $<?=$results[$x]['price']?></h6>
                                                    <h6><?=$results[$x]['large_size']?> - $<?=$results[$x]['large_price']?></h6>
                                                        
                                                        
                                                <?php }elseif(intval($results[$x]['price']) > 0){?>
                                                        
                                                    <h6>Price - $<?=$results[$x]['price']?></h6>
                                                <?php } ?>       
                                                            
                                                
                                            </div>
                                    </div>
                                </div>
                            </button>
                            <?php }           
                        } ?>
                    </div>
        
            </div>
        </section>

        <aside id="order-list">

        </aside>
        
        <footer>
            <div>
                <a href="https://www.google.com/maps?q=boardwalk+cafe+uwi&client=safari&rls=en&sxsrf=ALiCzsaaDE19JITymRQ19W3vY_puAZNZAQ:1669570799134&uact=5&gs_lcp=Cgxnd3Mtd2l6LXNlcnAQAzIECCMQJzIECCMQJzILCC4QgAQQxwEQrwE6BwgjELADECc6CggAEEcQ1gQQsAM6BwgAELADEEM6DAguEMgDELADEEMYAToPCC4Q1AIQyAMQsAMQQxgBOhIILhDHARCvARDIAxCwAxBDGAE6EAguEIAEEIcCEMcBEK8BEBQ6BQgAEIAEOgYIABAWEB5KBAhBGABKBAhGGAFQ4gZYmwxgww5oAXABeACAAdIBiAHaBJIBBTAuMy4xmAEAoAEByAESwAEB2gEGCAEQARgI&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjU5qP18877AhXiRDABHdd5AA0Q_AUoAXoECAEQAw">
                    <img src="images/location-icon.png">
                </a>

                <p>Boardwalk Caf&eacute; - UWI, Mona</p>
            </div>
            
            <div>
                <a href="https://www.facebook.com/uwiboardwalkcafe"><img src="images/facebook-logo.png"></a>
                <a href="https://www.instagram.com/theboardwalkcafeuwi/?hl=en"><img src="images/insta-logo.png"></a>
            </div>
            
        </footer>
        
    </div>
    
    <!--Testing manager functionality to add/update image
    <form action="test-imageUpload.php" method="post" enctype="multipart/form-data">
        <input name="menu-item-image" type="file">
        <input name="submit" type="submit" value="Upload">

    </form>
    -->

</body>
</html>