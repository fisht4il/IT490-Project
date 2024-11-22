<?php
require_once('apiFunctions.php');
//TODO READ
//THIS FILE IS FOR TESTING ONLY
//FOR ACTUAL IMPLEMENTATION, REQUESTS MUST GO THROUGH RABBITMQ!!!!

$request = array(
	'type' => 'DAILY', //options: DAILY, WEEKLY, MONTHLY
	'stock_symbol' => 'IBM' //can use any symbol!

);

requestApi($request);




?>
