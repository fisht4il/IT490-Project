#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


date_default_timezone_set('America/New_York');
/*  
function doLogout($sessionId) {
    try {
        global $config;
        $dbhost = $config['DBHOST'];
        $logindb = $config['LOGINDATABASE'];
        $dbLogin = "mysql:host=$dbhost;dbname=$logindb";
        $dbUsername = $config['DBUSER'];
        $dbPassword = $config['DBPASSWORD'];

        $pdo = new PDO($dbLogin, $dbUsername, $dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("DELETE from sessions WHERE session_id = :session_id");
        $stmt->bindParam(':session_id', $sessionId);
        $stmt->execute();

        return [
            "success" => true,
            "message" => "Logout successful."
        ];
    } catch (PDOException $e) {
        error_log('Database error: ' . $e->getMessage());
        return [
            "success" => false,
            "message" => "An error occurred during logout. Please try again later."
        ];
    }
}
 */

function requestProcessor($request) {
    if (!isset($request['type'])) {
        return json_encode([
            "success" => false,
            "message" => "ERROR: Unsupported message type"
        ]);
    }
    require_once('deploy-bundler.php');

    switch ($request['type']) {
	case "bundle":
	    
            $response = bundler($request);
	    break;
	case "deploy":
		
	    $response = deployer($request);
	/*
	case "bundler":
	    $client = newRabbitMQClient("testRabbitMQini", "dev-deploy");
	    $response = $client->send-request($request);
	    break;
	 */
	default:
            $response = [
                "success" => false,
                "message" => "ERROR: Unknown request type"
            ];
    }
    return json_encode($response);
}

$server = new rabbitMQServer("testRabbitMQ.ini", "devDeploy");
$server->process_requests('requestProcessor');
?>
