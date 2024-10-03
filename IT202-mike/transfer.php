<?php
require(__DIR__ . "/partials/nav.php");
require(__DIR__ . "/partials/dashboard.php");
if (!is_logged_in()) {
	flash("You don't have permission to view this page", "warning");
    die(header("Location: login.php"));
}
?>
<link rel="stylesheet" type="text/css" href="styles.css">
<h1>Transfer</h1>

<?php
require(__DIR__ . '/partials/flash.php');
?>