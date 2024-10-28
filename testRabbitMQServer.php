#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
$config = include('dbClient.php');

$requestsCounter = 0;
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

        // Fetch only the hashed password from the database.
        $stmt = $pdo->prepare("SELECT password FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            // it is to generate random charachter to get the session id
            $sessionId = bin2hex(random_bytes(16));
            $sessionStart = time();
            $sessionEnd = $sessionStart + 3600;

            // storing in the database
            $stmt = $pdo->prepare("INSERT INTO sessions (username, session_id, session_start, session_end) 
                                   VALUES (:username, :session_id, :session_start, :session_end)");
             $stmt->bindParam(':username', $username);
            $stmt->bindParam(':session_id', $sessionId);
            $stmt->bindParam(':session_start', $sessionStart);
            $stmt->bindParam(':session_end', $sessionEnd);
            $stmt->execute();

            return [
                "success" => true,
                "message" => "Login successful!",
                "sessionId" => $sessionId
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
function doValidate($sessionId) {
    try {
        global $config;
        $dbhost = $config['DBHOST'];
        $logindb = $config['LOGINDATABASE'];
        $dbLogin = "mysql:host=$dbhost;dbname=$logindb";
        $dbUsername = $config['DBUSER'];
        $dbPassword = $config['DBPASSWORD'];

        $pdo = new PDO($dbLogin, $dbUsername, $dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $currentEpochTime = time();

        // Checking the sessions
        $stmt = $pdo->prepare("SELECT * FROM sessions WHERE session_id = :session_id AND session_end > :current_time");
        $stmt->bindParam(':session_id', $sessionId);
        $stmt->bindParam(':current_time', $currentEpochTime);
        $stmt->execute();

        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            return [
                "success" => true,
                "message" => "Session is valid"
            ];
        } else {
            return [
                "success" => false,
                "message" => "Session is invalid or expired"
            ];
        }
    } catch (PDOException $e) {
        error_log('Database error: ' . $e->getMessage());
        return [
            "success" => false,
            "message" => "An error occurred during session validation."
        ];
    }
}

function requestProcessor($request) {
    global $requestsCounter;
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
            $response = doValidate($request['sessionId']);
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





