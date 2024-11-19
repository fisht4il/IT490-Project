<?php

session_start();

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

    $response = json_decode(json: $response, associative: true);

    if(isset($response['success']) && $response['success']) {
            $_SESSION['username'] = $username;
            echo json_encode(value: [
                    "success" => true,
                    "message" => "Registration successful.",
                    "redirect" => "/php/home.php"
            ]);
            exit;
    }

    header(header: 'Content-Type: application/json');

    echo json_encode(value: $response);

} else {
    http_response_code(response_code: 405);
    echo json_encode(value: [
        "success" => false,
        "message" => "Invalid request method."
    ]);
}


?>

