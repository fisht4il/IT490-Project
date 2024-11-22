<?php
require(__DIR__ . "/partials/nav.php");
require(__DIR__ . "/partials/dashboard.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css">
<h1>Withdraw</h1>

<form method="POST">
	<label for="account_id" class="form-label">Choose Account</label>
	<select name="account_id" id="account_id" class="form-select" required>
		<option value="Source Account">Source Account</option>	
	</select>

	<input type="number" name="amount" placeholder="Amount"/>
	<input type="text" name="memo" placeholder="Memo" />
	<input type="submit" value="Submit" name="submit"/>
</form>

<?php
require(__DIR__ . '/partials/flash.php');
?>