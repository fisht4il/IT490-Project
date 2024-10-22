<?php
session_start()

if(!(isset($_SESSION['username']) ) {
        header ("Location:/html/index.html");
        exit
}
?>

<!DOCTYPE html>
<html lang="en">
        <head>
                <title><Home</title>
                <link rel="stylesheet" href="style.css">
        </head>
        <body>
                <h1>Welcome <?php echo $_SESSION['username'];?></h1>
                <a href="/php/logout.php>Logout</a>
        </body>
</html>
