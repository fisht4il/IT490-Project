#!/usr/bin/php
<?php

require_once('../path.inc');
//require_once('../get_host_info.inc');
require_once('../RabbitMQ/rabbitMQLib.inc');
//$config = include('dbClient.php');

date_default_timezone_set('America/New_York');

if ($argc != 3){
	echo "something wrong: wrong bundler argument!\n";
	exit(1);
}

$bundleName = $argv[1];
$bundleFile = $argv[2];

$request = [
	'type' => "bundler",
	'name' => $bundleName,
	'tarball' => $bundleFile
];


//TODO implement rabbitmq testing betweem VMs, using one vm is not working
//$client = new RabbitMQClient("testRabbitMQ.ini", "dev-deploy");
//$response = $client->send_request($request);

require_once('test-deploy-bundler.php');
bundler($request);

//echo json_decode($response);


?>
