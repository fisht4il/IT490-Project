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
    	<title>Funds</title>
</head>
<body>
	<?php include 'partials/navbar.php'; ?>

        <div class="section-text">
            <?php echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "."; ?>
        </div>

	<section class="section-text">
		<h2>Funds</h2>
    	</section> 

    <div class="container">
         <h3>Balance: $<?php echo number_format((float)$current_balance, 2, '.', ','); ?></h3>
    </div>


	<section class="deposit-withdraw">

    <div class="div-slider">
        <label for="depositing-dithdrawing" class="dep-label">Deposit</label>
        <input id="depositing-dithdrawing" type="range" value="0" class="dw-slider" min="0" max="1" autocomplete="off">
        <label for="depositing-dithdrawing" class="with-label">Withdraw</label>
    </div>

    <div class="form-container" id="deposit-div">
        <h3 class="dw-label">Deposit</h3>
        <form>
	    <input type="number" class="input-field" placeholder="Enter amount to deposit">
	    <input type="submit" class="input-button" value="Submit">
	</form>
    </div>

    <div class="form-container" id="withdraw-div" style="display: none;">
        <h3 class="dw-label">Withdraw</h3>
	<form>	
	    <input type="number" class="input-field" placeholder="Enter amount to withdraw">
	    <input type="submit" class="input-button" value="Submit">
	</form>
    </div>
    </section>

<script>
    document.getElementById('depositing-dithdrawing').addEventListener('input', function(){
 
        const depositdiv = document.getElementById('deposit-div');
        const withdrawdiv = document.getElementById('withdraw-div');
 
        if(this.value == 0) {
            depositdiv.style.display = 'block';
            withdrawdiv.style.display = 'none';
        } else {
            depositdiv.style.display = 'none';
            withdrawdiv.style.display = 'block';
        }
    });
  </script>

  <!--  <?php include 'partials/chat.php'; ?> -->

	<?php include 'partials/footer.php'; ?>
</body>
</html>
