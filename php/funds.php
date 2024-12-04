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


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Funds</title>
</head>
<body>
    
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
    <a href="funds.php" class="nav-link">Funds</a>
    <a href="trades.php" class="nav-link">Trades</a>
    <a href="orders.php" class="nav-link">Orders</a>
    <a href="logout.php" class="nav-link">Logout</a>
  </nav>
</header>


    <section class="section-text">
        <h2>Funds</h2>
        </section>


<section class="deposit-withdraw">

    <div class="div-slider">
        <label for="depositing-dithdrawing" class="dep-label">Deposit</label>
        <input id="depositing-dithdrawing" type="range" value="0" class="dw-slider" min="0" max="1" autocomplete="off">
        <label for="depositing-dithdrawing" class="with-label">Withdraw</label>
    </div>

    <div class="funds-container" id="deposit-div">
        <h3 class="balance-php">Balance: $<?php echo number_format((float)$balance, 2, '.', ','); ?></h3>
        <h3 class="dw-label">Deposit</h3>
        <div class="btn-div">
            <button class="input-button">Deposit $20</button>
            <button class="input-button">Deposit $50</button>
            <button class="input-button">Deposit $100</button><br><br>
        </div>
        <input type="number" class="input-field" placeholder="e.g., $155.00">
    </div>

    <div class="funds-container" id="withdraw-div" style="display: none;">
        <h3 class="balance-php">Balance: $<?php echo number_format((float)$balance, 2, '.', ','); ?></h3>
        <h3 class="dw-label">Withdraw</h3>
        <div class="btn-div">
            <button class="input-button">Withdraw $20</button>
            <button class="input-button">Withdraw $50</button>
            <button class="input-button">Withdraw $100</button><br><br>
        </div>
        <input type="number" class="input-field" placeholder="e.g., $155.00">
    </div>
</section>

<script>
    document.getElementById('depositing-dithdrawing').addEventListener('input', function(){
 
        const depositdiv = document.getElementById('deposit-div');
        const withdrawdiv = document.getElementById('withdraw-div');
 
        if(this.value == 0) {
            depositdiv.style.display = 'block';
            withdrawdiv.style.display = 'none';
        } else {
            depositdiv.style.display = 'none';
            withdrawdiv.style.display = 'block';
        }
    });
  </script>

</body>
</html>
