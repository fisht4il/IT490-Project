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
        <h2>Graphs</h2>
    </section>

    <section id="stock-history">
        <h2>Stock Historical Data (AAPL)</h2>
        <canvas id="historicalChart"></canvas>
    </section>

    <?php include 'partials/footer.php'; ?>

    <script>
       
        const historicalData = <?php echo json_encode($historicalData); ?>;
        
        const dates = historicalData.map(data => data.date);
        const openPrices = historicalData.map(data => data.open);
        const highPrices = historicalData.map(data => data.high);
        const lowPrices = historicalData.map(data => data.low);
        const closePrices = historicalData.map(data => data.close);

        // Create the chart
        const ctx = document.getElementById('historicalChart').getContext('2d');
        const historicalChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [
                    {
                        label: 'Open Price',
                        data: openPrices,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        fill: false
                    },
                    {
                        label: 'High Price',
                        data: highPrices,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        fill: false
                    },
                    {
                        label: 'Low Price',
                        data: lowPrices,
                        borderColor: 'rgba(255, 159, 64, 1)',
                        fill: false
                    },
                    {
                        label: 'Close Price',
                        data: closePrices,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        type: 'category',
                        labels: dates,
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
    </script>
</body>
</html>

