<?php
    require "AuthAdmin.php";
    $error_message = "";
    if (isset($_POST['submit'])) {
        if ($_POST['password'] == $_POST['password-re-entry']){
            $auth = new AuthAdmin();
            $auth->registerNewUser($_POST['username'], $_POST['password']);
            //$_SESSION['user']
            header('Location: index.php'); 
        }
        else{
            $error_message = "Ensure both passwords match";
        }
    }
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account</title>
</head>
<body>
    <form action="userSignUp.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" required>
        <label for="number">Telephone Number</label>
        <input type="tel" name="number" required>
        <label for="password" >Password</label>
        <input type="password" name="password" minlength="8" required>
        <label for="password-re-entry" >Re-Enter Password</label>
        <input type="password" name="password-re-entry" minlength="8" required>
        <input type="submit" name="submit" value="Sign Up" />
    </form>
    <?php if ($error_message != "") { ?>
    <div class="error">
        <strong><?php echo $error_message; ?></strong>
    </div>
    <?php } ?>
</body>
</html>