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
<body>
    <?php include 'partials/navbar.php'; ?>

    <section class="section-text">
        <h2>Orders</h2>
    </section> 


    <main>
	<div class="form-container">
	    <h3>Limit Orders</h3>
            <form action="" class="form" method="post">
                <label for="stock-symbol">Stock Symbol</label>
                <div style="position: relative;">
                    <input type="text" id="stock-symbol" class="input-field" placeholder="Enter stock symbol">
                    <div id="suggestions" class="stock-dropdown"></div>
                </div>
                <label for="order-type">Order Type</label>
                <select name="order-type" id="order-type" class="input-field">
                    <option value="buy" class="options">Buy</option>
                    <option value="sell" class="options">Sell</option>
                </select>
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" class="input-field" placeholder="Enter quantity">
                <label for="total-price">Total Price</label>
                <input type="number" id="total-price" class="input-field" placeholder="Enter total price">
                <input type="submit" class="input-button" value="Submit Order">
            </form>
        </div>
    </main>

    <script>
        document.getElementById('stock-symbol').addEventListener('input', function() {
            const input = this.value.toLowerCase();
            const suggestionsContainer = document.getElementById('suggestions');
            suggestionsContainer.innerHTML = ''; // Clear previous suggestions

            if (input.length > 0) {
                const stocks = <?= json_encode($stocks); ?>;
                const filteredStocks = stocks.filter(stock => 
                    stock.symbol.toLowerCase().startsWith(input) || 
                    stock.name.toLowerCase().startsWith(input)
                );

                if (filteredStocks.length > 0) {
                    filteredStocks.forEach(stock => {
                        const suggestion = document.createElement('div');
                        suggestion.classList.add('stock-dropdown-item');
                        suggestion.textContent = `${stock.symbol} - ${stock.name}`;
                        suggestion.addEventListener('click', function() {
                            document.getElementById('stock-symbol').value = stock.symbol;
                            suggestionsContainer.innerHTML = '';
                            suggestionsContainer.style.display = 'none';
                        });
                        suggestionsContainer.appendChild(suggestion);
                    });
                    suggestionsContainer.style.display = 'block';
                } else {
                    suggestionsContainer.style.display = 'none';
                }
            } else {
                suggestionsContainer.style.display = 'none';
            }
        });

        
        document.addEventListener('click', function(event) {
            const suggestionsContainer = document.getElementById('suggestions');
            if (!document.getElementById('stock-symbol').contains(event.target) &&
                !suggestionsContainer.contains(event.target)) {
                suggestionsContainer.style.display = 'none';
            }
        });
    </script>

    <!--  <?php include 'partials/chat.php'; ?> -->

    <?php include 'partials/footer.php'; ?>
</body>
</html>
