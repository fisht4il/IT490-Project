<?php

session_start();

require_once('../RabbitMQ/path.inc');
require_once('../RabbitMQ/get_host_info.inc');
require_once('../RabbitMQ/rabbitMQLib.inc');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $client = new rabbitMQClient("testRabbitMQ.ini", "testServer");

    $request = [
        'type' => "register",
        'username' => $username,
        'password' => $password,
        'message' => "Registration Request"
    ];

    $response = $client->send_request($request);
    $response = json_decode($response, true);

    if (isset($response['success']) && $response['success']) {

        $_SESSION['username'] = $username;
        $_SESSION['session_id'] = $response['session_id'];

        echo json_encode([
            "success" => true,
            "message" => "Login successful.",
            "redirect" => "../index.html"
        ]);
        exit;
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

else {
    http_response_code(405);
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method."
    ]);
}

?>
