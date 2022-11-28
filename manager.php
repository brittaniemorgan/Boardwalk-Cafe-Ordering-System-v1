<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager - The Boardwalk Cafe</title>
</head>
<body>
    <?php
        require_once 'DBManager.php';
        require_once 'Metrics.php';

        #turn on error reporting
        ini_set('display_errors', 'On');
        error_reporting(E_ALL | E_STRICT);

        #connects to databse
        $host = 'localhost';
        $username = 'boardwalk_user';
        $password = 'password123';
        $dbname = 'cafeInfo';
        
        $db = new DBManager($host, $username, $password, $dbname);
        
        $metrics = new Metrics($db);
        $metrics->generateReport();
    ?>
    
</body>
</html>