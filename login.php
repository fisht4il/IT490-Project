<?php
require_once('get_host_info.inc');
require_once('path.inc');
require_once('rabbitMQLib.inc');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");

	$request = array();
	$request['type'] = "login";
	$request['username'] = $username;
	$request['password'] = $password;

	$response = $client->send_request($request);

	echo "client received response: ".PHP_EOL;
	print_r($response);
	echo "\n\n";
}

else {
	echo "Error";
}
?>
