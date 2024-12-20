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
    <title>Trades</title>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
        $('#buy-form').on('submit', function (e) {
            e.preventDefault();
            var stocksymbol = $('#stock-symbol').val();
            var quantity = $('#quantity').val();
            var totalprice = $('#total-price').val();
            var showRawJson = $('#show-json').is(':checked');

            $.ajax({
                url: '/php/transaction-trade.php',
                type: 'POST',
                data: {
                    stocksymbol: stocksymbol,
                    quantity: quantity,
                    totalprice: totalprice
                },
                success: function (response) {
                    handleResponse(response, showRawJson);
                },
                error: function () {
                    $('#response').html("<strong style='color:red;'>An error occurred. Please try again.</strong>");
                }
            });
        });

        $('#sell-form').on('submit', function (e) {
            e.preventDefault();
            var stocksymbol = $('#stock-symbol').val();
            var quantity = $('#quantity').val();
            var totalprice = $('#total-price').val();
            var showRawJson = $('#show-json').is(':checked');

            $.ajax({
                url: '/php/transaction-trade.php',
                type: 'POST',
                data: {
                    stocksymbol: stocksymbol,
                    quantity: quantity,
                    totalprice: totalprice
                },
                success: function (response) {
                    handleResponse(response, showRawJson);
                },
                error: function () {
                    $('#response').html("<strong style='color:red;'>An error occurred. Please try again.</strong>");
                }
            });
        });

        function handleResponse(response, showRawJson) {
            try {
                let result = typeof response === 'string' ? JSON.parse(response) : response;
                let color = result.success ? 'green' : 'red';
                let formattedResponse = `<pre><strong style="color:${color};">${result.message}</strong></pre><br>`;

                let rawJsonResponse = showRawJson
                    ? `<h4>Raw JSON Response:</h4><pre>${JSON.stringify(result, null, 2)}</pre>`
                    : '';

                $('#response').html(formattedResponse + rawJsonResponse);

                if (result.success && result.redirect) {
                    window.location.href = result.redirect;
                    return;
                }

            } catch (error) {
                console.error("JSON parse error:", error);
                $('#response').html(
                    `<pre><strong style='color:red;'>Invalid JSON response.</strong></pre>`
                );
            }
        }
    });
    </script>

</head>
<body>
    <?php include 'partials/navbar.php'; ?>

    <section class="section-text">
        <h2>Trades</h2>
    </section>

    <div class="container">
        <h3>Balance: $<?php echo number_format((float)$current_balance, 2, '.', ','); ?></h3>
    </div>

    <section class="buy-sell">
        <div class="div-slider">
            <label for="buying-selling" class="buy-sell-label">Buy</label>
            <input id="buying-selling" type="range" value="0" class="bs-slider" min="0" max="1">
            <label for="buying-selling" class="sell-buy-label">Sell</label>
        </div>

        <div class="form-container" id="buy-div">
            <h3>Buy Stocks</h3>
	    <form id="buy-form" class="form" method="post" autocomplete="off">
                    <label for="stock-symbol">Stock Symbol</label>
                    <div style="position: relative;">
                        <input type="text" id="stock-symbol" class="input-field" placeholder="Enter stock symbol">
                        <div id="suggestions" class="stock-dropdown"></div>
                    </div>
		    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" class="input-field" placeholder="Enter quantity">
		    <label for="total-price">Price</label>
                    <input type="text" id="total-price" class="input-field" placeholder="Enter price">
		    <input type="submit" class="input-button" value="Buy">
	    </form>
        </div>

        <div class="form-container" id="sell-div" style="display: none;">
            <h3>Sell Stocks</h3>
            <form id="sell-form" class="form" method="post" autocomplete="off">
                    <label for="stock-symbol">Stock Symbol</label>
                    <div style="position: relative;">
                        <input type="text" id="stock-symbol" class="input-field" placeholder="Enter stock symbol">
            <!-- TODO ONLY LIST STOCKS FROM PORTFOLIO  -->            <div id="" class="stock-dropdown"></div>
                    </div>
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" class="input-field" placeholder="Enter quantity">
                    <label for="total-price">Price</label>
                    <input type="text" id="total-price" class="input-field" placeholder="Enter price">
                    <input type="submit" class="input-button" value="Sell">
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
