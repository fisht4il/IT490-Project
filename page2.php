<?php
session_start();
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

if (!isset($_SESSION['session_id'])) {
    header("Location: ../index.html");
    exit();
}

$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");

$request = [
    'type' => "validate_session",
    'session_id' => $_SESSION['session_id']
];

$response = json_decode($client->send_request($request), true);

if (!$response['success']) {
    header("Location: ../index.html");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page-2</title>
</head>
<body class="body-home">
    <header class="main-header">
        <img src="finnhub-logo.png" alt="" class="logo-home">
        <h1 class="page-title">IT-490-Project</h1>
        <nav class="header-nav">
            <ul class="link-list">
                <li class="link-item">
                    <button class="btn">
                        <a href="home.php" class="placeholder-link">Home</a>
                    </button>
                </li>
                <li class="link-item">
                    <button class="btn">
                        <a href="page1.php" class="placeholder-link">Page-1</a>
                    </button>
                </li>
                <li class="link-item">
                    <div>
                        <?php
                        echo "Welcome, " . htmlspecialchars($_SESSION['username']) . ".";
                        ?>
                    </div>
                    <button class="input-submit">
                        <a href="logout.php" class="placeholder-link">Logout</a>
                    </button>
                </li>
            </ul>
        </nav>
    </header>
    <section class="section-text">
        <h2 class="home-title">PAGE-2</h2>
    </section>

    <button class="chat-btn" onclick="funcChat()">Help Chat</button>

    <section id="chatwindow" class="chat-window">
        <div class="chat-header">What can we help with</div>
        <div class="chat-content" id="chatcontent">
        </div>
        <div class="input-chat">
            <textarea id="chatinput" placeholder="Message..."></textarea>
            <button onclick="messageSend()">Send</button>
        </div>
    </section>

    <script>
        function funcChat() {
            var chatwindow = document.getElementById('chatwindow');
            chatwindow.style.display = (chatwindow.style.display === 'none' || chatwindow.style.display === '') ? 'flex' : 'none';
        }

        function messageSend() {
            var inputfield = document.getElementById('chatinput');
            var chatcontent = document.getElementById('chatcontent');

            if (inputfield.value.trim() !== '') {
                var message = document.createElement('div');
                message.textContent = inputfield.value;
                chatcontent.appendChild(message);

                inputfield.value = '';
                chatcontent.scrollTop = chatcontent.scrollHeight;
            }
        }
    </script>

    <footer class="footer">
        <p class="copyright">&copy; 2024. Copyright by IT-490-Project</p>
    </footer>
</body>
</html>
