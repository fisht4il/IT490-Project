<?php
// Start the session
session_start();

// Custom 403 page to deter unauthorized access
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    header('Content-Type: image/gif');

    // Serve a fun GIF or fallback message
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
}

?>

