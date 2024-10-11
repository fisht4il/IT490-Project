<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('testRabbitMQClient.php');

$username = $_POST["username"];

$password = $_POST["password"];

$passhash = password_hash($password, PASSWORD_DEFAULT);

$request = array();

$request['type'] = "login";
$request['username'] = $username;
$request['password'] = $passhash;

