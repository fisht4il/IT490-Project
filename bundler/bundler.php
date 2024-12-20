#!/usr/bin/php
<?php
//THIS FILE SHOULD BE ON DEV SIDE
//test-deploy-bundler.php should be on Deploy's side, but for test it is all same place

require_once('../path.inc');
//require_once('../get_host_info.inc');
require_once('../RabbitMQ/rabbitMQLib.inc');
//$config = include('dbClient.php');

date_default_timezone_set('America/New_York');

if ($argc != 2){
	echo "something wrong: wrong bundler argument!\n";
	exit(1);
}

$bundleName = $argv[1];
//$bundleFile = $argv[2];

$request = [
	'type' => "bundler",
	'name' => $bundleName//,
	//'tarball' => $bundleFile
];

$cllient = new RabbitMQClient("testRabbitMQ.ini","devDeploy");
$response = $client->send_request($request);


//TODO implement rabbitmq testing betweem VMs, using one vm is not working
//$client = new RabbitMQClient("testRabbitMQ.ini", "dev-deploy");
//$response = $client->send_request($request);


//shell_exec("");
//require_once('test-deploy-bundler.php');
//bundler($request);

//return json_decode($response['message']);


?>
