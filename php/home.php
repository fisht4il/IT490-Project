<?php
/*
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
*/
?>


<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
</head>


<!-- HEADER -->
<header class="main-header">
  <a href="home.php">
	<img src="../media/logo.png" alt="Logo" class="nav-logo">
 </a>
  <?php echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "."; ?>
  <!-- <h1 class="page-title">IT-490-Project</h1> -->
  <nav class="header-nav">
    <!--<form action="" id="searchForm" role="search" class="search">
      <input type="search" id="searchInput" class="search-input" placeholder="Search...">
      <input type="submit" class="submit-search">
    </form>-->
    <a href="recommendations.php" class="nav-link">Recommendations</a>
    <a href="trades.php" class="nav-link">Trades</a>
    <a href="orders.php" class="nav-link">Orders</a>
    <a href="logout.php" class="nav-link">Logout</a>
  </nav>
</header>


<body class="body-home">


  <section class="section-text">
    <h2>Dashboard</h2>
  </section>


  <div class="container">
    Investments<br>
    Account #: LAST 4 DIGITS<br>
    Value as of TIME AND DAY: $1000<br>
    Day change<br>
    Red or green<br>
  </div>


  <div class="container">
    <h3>Portfolio</h3>
    <table>
        <tr>
            <th>Stock</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
    </table>
  </div>


  <div class="container">
    <h3>Stock Performance</h3>
    <div class="chart">CHART GOES HERE</div>
  </div>


  <div class="container">
    <h3>Recommendations</h3>
    Recommendation 1<br>
    Recommendation 2<br>
    Recommendation 3<br>
  </div>


<!-- CHAT -->
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


<!-- FOOTER -->
<footer class="footer">
  <p>&copy; 2024. Copyright by IT-490-Project</p>
</footer>


</body>
</html>

