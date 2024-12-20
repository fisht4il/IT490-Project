#!/usr/bin/php
<?php

require '../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dbHost = $_ENV['deployHost'];
$dbUser = $_ENV['deployUser'];
$dbpass = $_ENV['deployPass'];
$dbName = $_ENV['deployName'];

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
//$config = include('dbClient.php');

date_default_timezone_set('America/New_York');

//=====
//bundler
//=====
function bundler($request){
	$name = $request['name'];
	if (!isset($name)){
		return;
	}
	//else
	try {
		global $dbHost;
		global $dbUser;
		global $dbPass;
		global $dbName;
        	$dbLogin = "mysql:host=$dbHost;dbname=$dbName";

        	$pdo = new PDO($dbLogin, $dbUser, $dbPass);
        	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $pdo->prepare("SELECT name, version FROM :dbname WHERE name=:name ORDER BY version DESC LIMIT 1");
		$stmt->bindParam(':dbname', $dbName);
        	$stmt->bindParam(':name', $name);
		$stmt->execute();
		$response = $stmt->fetch(PDO::FETCH_ASSOC);

		$version = 1.0; //default value
		if ($response){
			$version = $response['version'] + 0.1;
			$stmt = null;
			$stmt = $pdo->prepare("INSERT INTO :dbname (name, version) VALUES (:name, :version)");
			$stmt->bindParam(':dbname', $dbName);
                	$stmt->bindParam(':name', $name);
			$stmt->bindParam(':version', $newversion);
			$stmt->execute();

		} else {
			//use default version value
                        $stmt = null;
                        $stmt = $pdo->prepare("INSERT INTO :dbname (name, version) VALUES (:name, :version)");
                        $stmt->bindParam(':dbname', $dbName);
                        $stmt->bindParam(':name', $name);
                        $stmt->bindParam(':version', $version);
                        $stmt->execute();
		}

		//if any error at this point, would already be caught

		$versionFormat = number_format($version, 1);
		$nameFormat = $name . '_' . $versionFormat. '.tar.gz';
		$tarballPath = '../bundles/'. $nameFormat;

		$tarball = $request['tarball'];
		$tarballData = base64_decode($tarball);

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
        	
    	} catch (PDOException $e) {
        	error_log('Database error: ' . $e->getMessage());
        	return [
            		"success" => false,
           		"message" => "ERROR: Error with deployment db."
        	];
    	} finally {
		if ($stmt){
			$stmt=null;
		}
		$pdo=null;
	}


}

//

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
?>
