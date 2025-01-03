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
} else {
    $userId = $response['user_id'];
    $current_balance = $response['balance'];
    $stocksrecommendation = $response['stocksrecommendation'];
}
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

<body class="body-home">
    <?php include 'partials/navbar.php'; ?>

    <div class="section-text">
        <?php echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "."; ?>
    </div>

    <section class="section-text">
        <h2>Dashboard</h2>
    </section>

    <div class="container">
        <h3>Balance: $<?php echo number_format((float)$current_balance, 2, '.', ','); ?></h3>
    </div>

    <div class="container">
        <h3>Portfolio Evaluation</h3>
        <label>Value:</label><br><br> <!-- php account value -->
        <label>Day's gain/loss:</label><br><br> <!-- php gain/loss -->
        <label>Cash & sweep funds</label><br><br>
        <h3>Portfolio</h3>
        <table id="home-portfolio">
            <tr>
                <th>Stock</th>
                <th>Quantity</th>
                <th>Value</th>
                <th>Gain/Loss</th>
                <th>Chart</th>
            </tr>
        </table>
    </div>

    <div class="container">
        <h3>Recommendations</h3>
        <?php if (!empty($stocksrecommendation)): ?>
            <ul>
                <?php foreach ($stocksrecommendation as $stock): ?>
                    <li>
                        <?php echo $stock['symbol']; ?> - Price: $<?php echo $stock['price']; ?>, 
                        Change: <?php echo $stock['change_percent']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No recommendations available at the moment.</p>
        <?php endif; ?>
    </div>

    <!--  <?php include 'partials/chat.php'; ?> -->

    <?php include 'partials/footer.php'; ?>

</body>
</html>
