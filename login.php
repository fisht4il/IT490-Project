<?php
session_start();
require_once('get_host_info.inc');
require_once('path.inc');
require_once('rabbitMQLib.inc');

$valid_username = "user";
$valid_password = "password";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");

	$request = array();
	$request['type'] = "login";
	$request['username'] = $username;
	$request['password'] = $password;

	$response = $client->send_request($request);

	if ($username === $valid_username && $password === $valid_password) {
		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = $username;
		header("Location: home.php");
		exit;
	}

	else {
		echo "<p>Invalid username or password</p>";
		echo "<p><a href=\"index.html\">Try again</a></p>";
	}

	echo "client received response: ".PHP_EOL;
	print_r($response);
	echo "\n\n";
}

else {
	header("Location: index.html");
	exit;
}

?>
