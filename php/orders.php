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

// Get stocks list from the response
$stocks = $response['stocks']; // stocks fetched in doValidate function
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
    <title>Orders</title>
</head>
<body class="body-home">
    <?php include 'partials/navbar.php'; ?>

    <section class="section-text">
        <h2>Orders</h2>
    </section> 

    <main>
        <form id="" class="form">
            <h2 class="h2-title">Limit Orders</h2>
            <div class="form-div">
                <label class="input-label" for="stock-symbol">Stock Symbol</label>
                <select name="stock-symbol" id="stock-symbol" class="input-field">
                    <option value="" selected>Select stock symbol</option>
                    <?php foreach ($stocks as $stock): ?>
                        <option value="<?= htmlspecialchars($stock['symbol']) ?>"><?= htmlspecialchars($stock['symbol']) ?> - <?= htmlspecialchars($stock['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-div">
                <label class="input-label" for="order-type">Order Type</label>
                <select name="order-type" id="order-type" class="input-field">
                    <option value="" selected>Select order type</option>
                    <option value="buy">Buy</option>
                    <option value="sell">Sell</option>
                </select>
            </div>
            <div class="form-div">
                <label class="input-label" for="quantity">Quantity</label>
                <input type="number" class="input-field" id="quantity" name="quantity" required placeholder="Enter quantity">
            </div>
            <div class="form-div">
                <label class="input-label" for="total-price">Total Price</label>
                <input type="number" class="input-field" id="total-price" name="total-price" required placeholder="Enter total price">
            </div>
        </form>
    </main>

    <?php include 'partials/footer.php'; ?>
</body>
</html>

