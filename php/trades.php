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
    <title>Trades</title>
</head>
<body>
    <?php include 'partials/navbar.php'; ?>

    <section class="section-text">
        <h2>Trades</h2>
    </section>

    <section class="buy-sell">
        <div class="div-slider">
            <label for="buying-selling" class="buy-sell-label">Buy</label>
            <input id="buying-selling" type="range" value="0" class="bs-slider" min="0" max="1">
            <label for="buying-selling" class="sell-buy-label">Sell</label>
        </div>

        <div class="container" id="buy-div">
            <h2 class="h2-title">Buy Stocks</h2>
	    <form action="" class="form" method="post">
	        <div class="form-div">
                    <label for="" class="con-label">Stock Symbol</label>
                    <input type="text" class="input-field" placeholder="Enter stock symbol">
		</div>
		<div class="form-div">
		    <label for="" class="con-label">Quantity</label>
                    <input type="number" class="input-field" placeholder="Enter quantity">
		</div>
		<div class="form-div">
		    <label for="" class="con-label">Price</label>
                    <input type="text" class="input-field" placeholder="Enter price">
		</div>
		<div class="form-div">
		    <input type="submit" class="input-button" value="Buy">
	        </div>
	    </form>
        </div>

        <div class="container" id="sell-div" style="display: none;">
            <h2 class="h2-title">Sell Stocks</h2>
	    <form action="" class="form" method="post">
	        <div class="form-div">
                    <label for="" class="con-label">Stock Symbol</label>
		    <input type="text" class="input-field" placeholder="Enter stock symbol">
		</div>
		<div class="form-div">
                    <label for="" class="con-label">Quantity</label>
                    <input type="number" class="input-field" placeholder="Enter quantity">
		</div>
		<div class="form-div">		
		    <label for="" class="con-label">Price</label>
                    <input type="text" class="input-field" placeholder="Enter price">
		</div>
		<div class="form-div">		
		    <input type="submit" class="input-button" value="Sell">
		</div>
            </form>
        </div>
    </section>

    <script>
      document.getElementById('buying-selling').addEventListener('input', function(){

        const buydiv = document.getElementById('buy-div');
        const selldiv = document.getElementById('sell-div');

        if(this.value == 0) {
          buydiv.style.display = 'block';
          selldiv.style.display = 'none';
        } else {
          buydiv.style.display = 'none';
          selldiv.style.display = 'block';
        }
      });
    </script>

    <!--  <?php include 'partials/chat.php'; ?> -->

    <?php include 'partials/footer.php'; ?>
</body>
</html>
