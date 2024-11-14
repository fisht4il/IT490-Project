<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['username'];
	$password = $_POST['password'];

	echo "Username:  " . htmlspecialchars($username) . "<br>";
	echo "Password:  " . htmlspecialchars($password) . "<br>";
}

else {
	echo "Invalid";
}	
?>
