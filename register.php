<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

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

    header('Content-Type: application/json');

    echo json_encode($response);

} else {
    http_response_code(405);
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method."
    ]);
}

?>


