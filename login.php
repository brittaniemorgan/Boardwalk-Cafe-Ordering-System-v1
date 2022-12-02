<link rel="stylesheet" href="login.css">
<?php
    session_start();
    if ((isset($_SESSION['user']) && $_SESSION['user'] != false)) {
        header('Location: index.php');
    }

    require_once "AuthAdmin.php";
    $error_message = '';
    if (isset($_POST['submit'])) {
        $auth = new AuthAdmin();
        $response = $auth->checkPassword($_POST['username'], $_POST['password']);
        $error_message = '';
        if (!$response) {
            $error_message = "Incorrect username or password";
        }
        else{
            $_SESSION['user'] = $response;
            header('Location: index.php');  
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
</head>
<body>
    <form action="login.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="username" required>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="password" required>
        <input type="submit" name="submit" value="Login" />
    </form>
    <?php if ($error_message != "") { ?>
    <div class="error">
        <strong><?php echo $error_message; ?></strong>
    </div>
    <?php } ?>
    <a href="userSignUp.php">Create New Account</a>
    
</body>
</html>