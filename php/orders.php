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
    <title>Orders</title>
</head>
<body>
    <?php include 'partials/navbar.php'; ?>

    <section class="section-text">
        <h2>Orders</h2>
    </section> 

    <main>
	
        <div class="form-container">
	    <h2 class="h2-title">Limit Orders</h2>
            <form action="" class="form" method="post">
                <label for="">Stock Symbol</label>
                <input type="text" class="input-field" placeholder="Enter stock symbol">
                <label for="">Order Type</label>
                <select name="" id="" class="input-field">
		    <option value="" selected>Select order type</option>
                    <option value="" class="options">Buy</option>
                    <option value="" class="options">Sell</option>
                </select>
                <label for="">Quantity</label>
                <input type="number" class="input-field" placeholder="Enter quantity">
                <label for="">Total Price</label>
                <input type="number" class="input-field" placeholder="Enter total price">
                <input type="submit" class="input-button" value="Submit Order">
            </form>
        </div>

    </main>

    <!--  <?php include 'partials/chat.php'; ?> -->

    <?php include 'partials/footer.php'; ?>
</body>
</html>
