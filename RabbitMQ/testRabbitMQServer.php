#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
$config = include('dbClient.php');

date_default_timezone_set('America/New_York');

function doRegister($username, $password) {
    try {
        global $config;
        $dbhost = $config['DBHOST'];
	$logindb = $config['LOGINDATABASE'];
	$stockdb = $config['STOCKDATABASE'];
	$dbLogin = "mysql:host=$dbhost;dbname=$logindb";
	$dbStock = "mysql:host=$dbhost;dbname=$stockdb";
        $dbUsername = $config['DBUSER'];
        $dbPassword = $config['DBPASSWORD'];

        $pdo = new PDO($dbLogin, $dbUsername, $dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdoStock = new PDO($dbStock, $dbUsername, $dbPassword);
        $pdoStock->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, password, last_login) VALUES (:username, :password, NULL)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();

        $userId = $pdo->lastInsertId();

        $stmtStock = $pdoStock->prepare("INSERT INTO user_wallet (user_id, current_balance) VALUES (:user_id, :current_balance)");
        $stmtStock->bindParam(':user_id', $userId);
        $stmtStock->bindValue(':current_balance', 1000.00);
        $stmtStock->execute();

        return [
            "success" => true,
            "message" => "Registration successful!"
        ];

    } catch (PDOException $e) {
     	error_log('Database error: ' . $e->getMessage());
        return [
            "success" => false,
            "message" => "An error occurred during registeration. Please try again later."
        ];
    }
}

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

        $stmt = $pdo->prepare("SELECT password FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {

            $stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $sessionId = bin2hex(random_bytes(16));
            $timeLimit = 30;

            $stmt = $pdo->prepare("REPLACE INTO sessions (username, session_id, session_start, session_end) 
                                   VALUES (:username, :session_id, UNIX_TIMESTAMP(), UNIX_TIMESTAMP() + :timelimit)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':session_id', $sessionId);
            $stmt->bindParam(':timelimit', $timeLimit);
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


//=====
//doValidate
//=====

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

        $stmt = $pdo->prepare("SELECT session_end FROM sessions WHERE session_id = :session_id");
        $stmt->bindParam(':session_id', $sessionId);
        $stmt->execute();
        $session = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($session) {
		$stmt= $pdo->prepare("SELECT id FROM users WHERE username IN(SELECT username FROM sessions WHERE session_id = :sessionId)");
		$stmt->bindParam(':sessionId', $sessionId);
		$userId = $stmt->fetchColumn();
		
//select id from users where username in(select username from sessions where session_id = '27e43c0d5d4f0d1df3be4f307ff33027');


            $currentTime = time();

            if ($currentTime > $session['session_end']) {
                return [
                    "success" => false,
                    "message" => "Session expired. Please log in again."
                ];
            } else {
                $endTime = $currentTime + 30;
                $stmt = $pdo->prepare("UPDATE sessions SET session_end = :end_time WHERE session_id = :session_id");
                $stmt->bindParam(':end_time', $endTime);
                $stmt->bindParam(':session_id', $sessionId);
                $stmt->execute();

		$stmt = null;
		$pdo = null;
                return [
                    "success" => true,
		    "message" => "Session validated.",
		    "user_id" => $userId,
		    "balance" => showGetBalance($userId)
                ];
            }
        } else {
            return [
                "success" => false,
                "message" => "Invalid session ID."
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
function showGetBalance($userId){
	$bal = doGetBalance($userId);
	return $bal['balance'];
}

function doGetBalance($userId) {
    try {
        global $config;
        $dbhost = $config['DBHOST'];
        $stockdb = $config['STOCKDATABASE'];
        $dbStock = "mysql:host=$dbhost;dbname=$stockdb";
        $dbUsername = $config['DBUSER'];
        $dbPassword = $config['DBPASSWORD'];

        $pdoStock = new PDO($dbStock, $dbUsername, $dbPassword);
        $pdoStock->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmtStock = $pdoStock->prepare("SELECT current_balance FROM user_wallet WHERE user_id = :user_id");
        $stmtStock->bindParam(':user_id', $userId);
        $stmtStock->execute();

        $balance = $stmtStock->fetch(PDO::FETCH_ASSOC);

        if ($balance) {
            return [
                "success" => true,
                "message" => "Get dat bag",
                "balance" => $balance['current_balance']
            ];
        } else {
            return [
                "success" => false,
		"message" => "Bag not found.",
		"balance" => "31415" //TODO ERROR TEST
            ];
        }
    } catch (PDOException $e) {
        error_log('Database error: ' . $e->getMessage());
        return [
            "success" => false,
	    "message" => "An error occurred while retrieving the balance.",
	    "balance" => "404" //TODO ERROR TEST
        ];
    }
}

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

function requestProcessor($request) {
    if (!isset($request['type'])) {
        return json_encode([
            "success" => false,
            "message" => "ERROR: Unsupported message type"
        ]);
    }

    switch ($request['type']) {
	case "register":
	    $response = doRegister($request['username'], $request['password']);
	    break;
        case "login":
            $response = doLogin($request['username'], $request['password']);
            break;
        case "validate_session":
            $response = doValidate($request['session_id']);
            break;
        case "get_balance":
            $response = doGetBalance($request['user_id']);
            break;
	case "logout":
            $response = doLogout($request['session_id']);
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
$server->process_requests('requestProcessor');
?>
