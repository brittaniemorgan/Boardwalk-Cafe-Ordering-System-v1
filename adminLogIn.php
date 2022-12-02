<?php
    session_start();


    require_once "AuthAdmin.php";
    $error_message = '';
    if (isset($_POST['submit'])) {
        $auth = new AuthAdmin();
        $response = $auth->verifyAdmin($_POST['username'], $_POST['password']);
        $error_message = '';
        if (!$response) {
            $error_message = "Incorrect username or password";
        }
        else{
            $_SESSION['admin'] = $response;
            switch($_SESSION['admin'][2]){
                case 'manager':
                    header('Location: managerPage.php'); 
                    break;
                case 'server':
                    header('Location: Server.php'); 
                    break;
                case 'delivery personnel':
                    header('Location: deliveryPersonnel.php'); 
                    break;
                case 'chef': 
                    header('Location: Server.php');
                    break;
            }            
        }
     
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminLogin.css">
    <title>Log In</title>
</head>
<body>
    <div class="logMain">
        <h3>Login</h3>
    <form action="adminLogin.php" method="post">
        <label for="username" class="userNameh">Username</label>
        <input type="text" name="username" placeholder="Username" required class="username">
        <br><br>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" required class="password">
        <br><br>
        <input type="submit" name="submit" value="Login" class="login"/>
    </form>
    <?php if ($error_message != "") { ?>
    <div class="error">
        <strong><?php echo $error_message; ?></strong>
    </div>
    <br>
    <?php } ?>
    <a href="userSignUp.HTML">Create New Account</a>
    </div>
    
</body>
</html>