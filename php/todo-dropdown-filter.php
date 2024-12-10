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


else {
	$userId = $response['user_id'];
	$current_balance = $response['balance'];	
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

<! -- todo start -->
<! -- TODO move this style to the proper styles.css sheet once ready to do so -->
<style>
#myInput {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ddd;
}

#dropdown {
  display: none;
  position: absolute;
  background-color: #f6f6f6;
  border: 1px solid #ddd;
  max-height: 200px;
  overflow-y: auto;
  width: 100%;
}

#dropdown li {
  padding: 10px;
  cursor: pointer;
}

#dropdown li:hover {
  background-color: #ddd;
}
</style> 
<! -- todo end -->
</head>
<body class="body-home">
    <?php include 'partials/navbar.php'; ?>

    <section class="section-text">
        <h2>Dashboard</h2>
    </section>

    <div class="container">
        <h3>Balance: $<?php echo number_format((float)$current_balance, 2, '.', ','); ?></h3>
    </div>

    <div class="container">
        <h3>Portfolio</h3>
        <table>
                <tr>
                        <th>Stock</th>
                        <th>Chart</th>
                        <th>Day Change</th>
                        <th>Overall Change</th>
                </tr>
        </table>
    </div>

    <div class ="container">
    <!-- This dropdown menu is based on https://www.w3schools.com/howto/howto_js_filter_dropdown.asp as well as previous work -->
        <body>
        <h2>Searchable Country Dropdown</h2>
        <p>Start typing in the input field to filter the countries:</p>

        <input type="text" id="myInput" onkeyup="filterFunction()" placeholder="Select a Stock Symbol...">
        <ul id="dropdown">
        <!-- TODO these are hard-coded values, you would use a different function + rabbitmq if you want it to show values based on what's in the popular_stocks table -->
          <li>AAPL</li>
          <li>ADP</li>
          <li>AMC</li>
          <li>AMD</li>
          <li>AMZN</li>
          <li>BABA</li>
          <li>GME</li>
          <li>GOOGL</li>
          <li>HOOD</li>
          <li>IBM</li>
          <li>META</li>
          <li>MSFT</li>
          <li>NFLX</li>
          <li>NVDA</li>
          <li>ORCL</li>
          <li>RBLX</li>
          <li>SBUX</li>
          <li>SPY</li>
          <li>TSLA</li>
          <li>TSM</li>
          <li>UBER</li>
        </ul>

        <script>
        function filterFunction() {
          const input = document.getElementById("myInput");
          const filter = input.value.toUpperCase();
          const dropdown = document.getElementById("dropdown");
          const options = dropdown.getElementsByTagName("li");
        
          if (filter.length > 0) {
            dropdown.style.display = "block";
          } else {
            dropdown.style.display = "none";
          }
        
          let matchFound = false;
          for (let i = 0; i < options.length; i++) {
            const txtValue = options[i].textContent || options[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              options[i].style.display = "";
              matchFound = true;
            } else {
              options[i].style.display = "none";
            }
          }
        
          if (!matchFound) {
            dropdown.style.display = "none";
          }
        }
        
        document.getElementById("myInput").addEventListener("click", function() {
          const dropdown = document.getElementById("dropdown");
          dropdown.style.display = "block";
        });

        document.addEventListener("click", function(event) {
          const dropdown = document.getElementById("dropdown");
          const input = document.getElementById("myInput");
          if (!dropdown.contains(event.target) && event.target !== input) {
            dropdown.style.display = "none";
          }
        });
        
        document.getElementById("dropdown").addEventListener("click", function(event) {
          if (event.target.tagName === "LI") {
            document.getElementById("myInput").value = event.target.textContent;
            document.getElementById("dropdown").style.display = "none";
          }
        });
        </script>
        </body>
    </div>

    <!-- <?php include 'partials/chat.php'; ?> -->

    <?php include 'partials/footer.php'; ?>

</body>
</html>
