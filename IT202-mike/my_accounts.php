<?php
require(__DIR__ . "/partials/nav.php");
require(__DIR__ . "/partials/dashboard.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css">
<h1>My Accounts</h1>
<form method="POST">
    <input type="search" name="role" placeholder="Account Filter" value="<?php se($_POST, "account_number");?>" />
    <input type="submit" value="Search" />
</form>

<table>
    <thead>
        <th>Account Number</th>
        <th>Account Type</th>
        <th>Modified</th>
        <th>Balance</th>
    </thead>

    <tbody>
        <tr>
            <td colspan="100%">No accounts</td>
        </tr>
    </tbody>
</table>