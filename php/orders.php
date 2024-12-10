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
$stocks = $response['stocks']; // Ensure this array contains {symbol, name} pairs
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Titillium+Web:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <style>
      
       .stock-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: #051a12;
            border: 1px solid #31bc80;
            border-radius: 5px;
            max-height: 150px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .stock-dropdown-item {
            padding: 10px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .stock-dropdown-item:hover {
            background-color: #31bc80;
            color: #051a12;
        }

        .stock-dropdown-item.selected {
            background-color: #2ea972;
            color: #ffffff;
        }
    </style>
</head>
<body class="body-home">
    <?php include 'partials/navbar.php'; ?>

    <section class="section-text">
        <h2>Orders</h2>
    </section> 

    <main>
        <form id="" class="form">
            <h2 class="h2-title">Limit Orders</h2>
            <div class="form-div" style="position: relative;">
                <label class="input-label" for="stock-symbol">Stock Symbol</label>
                <input type="text" id="stock-symbol" class="input-field" name="stock-symbol" placeholder="Enter stock symbol">
                <div id="suggestions" class="stock-dropdown"></div>
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
</body>
</html>

