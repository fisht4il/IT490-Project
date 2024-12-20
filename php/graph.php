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

$historicalData = $response['historicalData'];
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="body-home">
    <?php include 'partials/navbar.php'; ?>

    <section class="section-text">
        <h2>Graph</h2>
        <label for="stockSelector">Select Stock:</label>
        <select id="stockSelector">
            <option value="" disabled>Select a stock</option>
            <?php foreach ($historicalData as $symbol => $data): ?>
                <option value="<?= $symbol ?>" <?= $symbol == 'AAPL' ? 'selected' : '' ?>><?= $symbol ?></option>
            <?php endforeach; ?>
        </select>
    </section>

    <section id="stock-history">
        <canvas id="stockChart" style="background-color: white;"></canvas>
    </section>

    <?php include 'partials/footer.php'; ?>

    <script>
        const historicalData = <?php echo json_encode($historicalData); ?>;
        const stockSelector = document.getElementById('stockSelector');
        const ctx = document.getElementById('stockChart').getContext('2d');
        let stockChart;

        function renderChart(stockData) {
            const reversedData = stockData.slice().reverse();
            const dates = reversedData.map(data => data.date);
            const highPrices = reversedData.map(data => data.high);
            const lowPrices = reversedData.map(data => data.low);

            if (stockChart) {
                stockChart.destroy();
            }

            stockChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [
                        {
                            label: 'High Price',
                            data: highPrices,
                            borderColor: 'green',
                            backgroundColor: 'rgba(0, 128, 0, 0.1)',
                            fill: false,
                            tension: 0.4
                        },
                        {
                            label: 'Low Price',
                            data: lowPrices,
                            borderColor: 'red',
                            backgroundColor: 'rgba(255, 0, 0, 0.1)',
                            fill: false,
                            tension: 0.4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            type: 'category',
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            beginAtZero: false,
                            title: {
                                display: true,
                                text: 'Price ($)'
                            }
                        }
                    }
                }
            });
        }

        stockSelector.addEventListener('change', function () {
            const selectedStock = stockSelector.value;
            const stockData = historicalData[selectedStock];
            renderChart(stockData);
        });

        document.addEventListener('DOMContentLoaded', function () {
            const selectedStock = stockSelector.value || 'AAPL';
            const stockData = historicalData[selectedStock];
            renderChart(stockData);
        });
    </script>
</body>
</html>

