#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
$config = include('dbClient.php');

date_default_timezone_set('America/New_York');

function doLogin($username, $password) {
    try {
        global $config;
        $dbhost = $config['DBHOST'];
        $logindb = $config['LOGINDATABASE'];
        $dbLogin = "mysql:host=$dbhost;dbname=$logindb";
        $dbUsername = $config['DBUSER'];
        $dbPassword = $config['DBPASSWORD'];

        $pdo = new PDO($dbLogin, $dbUsername, $dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch hashed password and check login
        $stmt = $pdo->prepare("SELECT password FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {

            $stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();


            $sessionId = bin2hex(random_bytes(16));


            $stmt = $pdo->prepare("INSERT INTO sessions (username, session_id, session_start) VALUES (:username, :session_id, UNIX_TIMESTAMP())");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':session_id', $sessionId);
            $stmt->execute();

            return [
                "success" => true,
                "message" => "Login successful!",
                "session_id" => $sessionId 
            ];
        } else {
            return [
                "success" => false,
                "message" => "Invalid username or password."
            ];
        }
    } catch (PDOException $e) {
        error_log('Database error: ' . $e->getMessage());
        return [
            "success" => false,
            "message" => "An error occurred during login. Please try again later."
        ];
    }
}


function requestProcessor($request) {
    $logFile = __DIR__ . '/received_messages.log';
    $logTime = date('m-d-Y H:i:s');
    $logRequest = "[" . $logTime . "] Received request: " . print_r($request, true) . PHP_EOL;
    file_put_contents($logFile, $logRequest, FILE_APPEND);

    if (!isset($request['type'])) {
        return json_encode([
            "success" => false,
            "message" => "ERROR: Unsupported message type"
        ]);
    }

    switch ($request['type']) {
      case "login":
            $response = doLogin($request['username'], $request['password']);
            break;
        case "validate_session":
            $response = doValidate($request['session_id']);
            break;
        default:
            $response = [
                "success" => false,
                "message" => "ERROR: Unknown request type"
            ];
    }

    return json_encode($response);
}

$server = new rabbitMQServer("testRabbitMQ.ini", "testServer");

echo "testRabbitMQServer BEGIN" . PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END" . PHP_EOL;
exit();


