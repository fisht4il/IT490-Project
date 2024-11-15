<?php
session_start();
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

if (isset($_SESSION['session_id'])) {
    $client = new rabbitMQClient("testRabbitMQ.ini", "testServer");

    $request = [
        'type' => "logout",
        'session_id' => $_SESSION['session_id'],
        'message' => "Logout Request"
    ];

    $response = $client->send_request($request);
    $response = json_decode($response, true);

    if ($response['success']) {
        session_unset();
        session_destroy();
        header("Location: http://localhost/index.html");
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    echo json_encode([
        "success" => false,
        "message" => "No active session found."
    ]);
}
?>
