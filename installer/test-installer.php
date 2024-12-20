#!/usr/bin/php
<?php

require '../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dbHost = $_ENV['deployHost'];
$dbUser = $_ENV['deployUser'];
$dbPass = $_ENV['deployPass'];
$dbName = $_ENV['deployName'];

require_once('../RabbitMQ/path.inc');
//require_once('get_host_info.inc');
require_once('../RabbitMQ/rabbitMQLib.inc');
//$config = include('dbClient.php');

date_default_timezone_set('America/New_York');

//============
//!!! NOTE !!!
//This file is for test, without rabbitmq, because I want to test functionality without messaging yet

//=====
//bundler
//=====
function installer($request){
	$name = $request['name'];
	if (!isset($name)){
		return;
	}
	$versionFormat = number_format($request['version'], 1);
        $nameFormat = $name . '_' . $versionFormat . '.tar.gz';
	echo $nameFormat;

	$tarballPath = './bundles/'. $nameFormat;
        $tarball = $request['tarball'];
	//$tarballData = base64_decode($tarball);
	$tarballData = $tarball;
	file_put_contents($tarballPath, $tarballData);
	/*
        if (file_put_contents($tarballPath, $tarballData)){

               return[
                        "success" => true,
                        "message" => "tarball saved as " . $nameFormat . " \nfull path: " . $tarballPath . "\n"
               ];

        } else {
                return [
                	"success" => false,
                        "message" => "ERROR: could not save tarball"
        	];
	}
	 */
	try {
		$extractPath = '../extracted/' . $name . '_' . $versionFormat;
		//echo "Target path: " . $extractPath . "\n";
		$command = "tar -xzvf $tarballPath -C $extractPath";
		//$command = "tar -xzvf $tarball -C $extractPath";
		$output = [];
		$returnvar = 0;
		exec($command, $output, $returnVar);


		//TODO copy over to proper paths

		if ($returnVar !== 0){
			throw new Exception("ERROR: " . implode("\n", $output));
		}
		
		

	} catch (Exception $e) {
		return [
			"success" => false,
			"message" => "ERROR: " . $e->getMessage() . "\n"
		];
	}
	//todo re-run commands to see if working
	//then return success or failed status




//TODO implement method for sending back success/failed status for bundle

}
//


// btw this is old code from bundler, update for installer
/* TODO re-implement properly
function requestProcessor($request) {
    if (!isset($request['type'])) {
        return json_encode([
            "success" => false,
            "message" => "ERROR: Unsupported message type"
        ]);
    }

    switch ($request['type']) {
	case "bundler":
	    $response = bundler($request);
	    break;
	default:
            $response = [
                "success" => false,
                "message" => "ERROR: Unknown request type"
            ];
    }
    return json_encode($response);
}

$server = new rabbitMQServer("testRabbitMQ.ini", "dev-deploy");
$server->process_requests('requestProcessor');
 */
?>
