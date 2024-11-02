?php

session_start();

// Custom 403 page to deter unauthorized access
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    header('Content-Type: image/gif');
    $gifPath = __DIR__ . '/../media/swamp.gif';
    if (file_exists($gifPath)) {
        readfile($gifPath);
    } else {
        echo "This is where I would have my GIF.... IF I HAD ONE!";
    }
    exit;
}

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $client = new rabbitMQClient("testRabbitMQ.ini", "testServer");

    $request = [
        'type' => "login",
        'username' => $username,
        'password' => $password,
        'message' => "Login Request"
    ];

    $response = $client->send_request($request);
    $response = json_decode($response, true);

    if (isset($response['success']) && $response['success']) {

        $_SESSION['username'] = $username;
        $_SESSION['session_id'] = $response['session_id'];

        echo json_encode([
            "success" => true,
            "message" => "Login successful.",
            "redirect" => "/php/home.php"
        ]);
        exit;
    }

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


