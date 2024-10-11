<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('testRabbitMQClient.php');

$username = $_POST["username"];

$password = $_POST["password"];

$passhash = password_hash($password, PASSWORD_DEFAULT);

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}
$request = array();
$request['type'] = "login";
$request['username'] = $username;
$request['password'] = $passhash;
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;

