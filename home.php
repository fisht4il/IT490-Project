<?php
// Start the session
session_start();
//this one checks if user is loged in or not if not it will redirect to inde.html file
//if (!(isset($_SESSION['username']) ){
        //header ("Location:/html/index.html");
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
<h1>Welcome <?php echo $_SESSION['username'];?></h1>
    <a href="/php/logout.php">Logout</a>
</body>
</html>

