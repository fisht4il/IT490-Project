<?php
require(__DIR__ . "/partials/nav.php");
require(__DIR__ . "/partials/dashboard.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css">
<h1>Create Account</h1>

<form method="POST">
    <label for="account_type">Account Type:</label>
    <select name="account_type" id="account_type">
        <option value="Checking">Checking</option>
    </select>
    <label for="balance">Deposit Minimum $5:<label>
    <input type="number" name="balance"></input>
    <input type="submit" value="Create Account">
</form>

<?php
require(__DIR__ . '/partials/flash.php');
?>