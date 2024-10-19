<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
	header("Location: index.html");
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Home</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<h1>Home</h1>
		<a href="logout.php">Logout</a>
	</body>
</html>
