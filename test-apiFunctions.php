<?php
require_once('apiFunctions.php');
//TODO READ
//THIS FILE IS FOR TESTING ONLY
//FOR ACTUAL IMPLEMENTATION, REQUESTS MUST GO THROUGH RABBITMQ!!!!

if ($argc < 2 || $argv[1] == null){
	echo "Invalid or Missing Argument\nOptions:{timeseries|quote}\n";
	exit(1);
}

//else
$arg = $argv[1];

//globalQuote
function globalQuote(){
	$request = array(
		'type' => 'QUOTE',
		'stock_symbol' => 'IBM'
	);
	return $request;
}

//timeSeries
function timeSeries(){
	$request = array(
		'type' => 'DAILY', //options: DAILY, WEEKLY, MONTHLY
		'stock_symbol' => 'IBM' //can use any symbol!

	);
	return $request;
}

switch($arg){
	case 'timeseries':
		$request = timeSeries();
		break;
	case 'quote':
		$request = globalQuote();
		break;
	default:
		echo "Invalid or Missing Argument\nOptions:{timeseries|quote}\n";
		exit(1);
}



//finally
requestApi($request);




?>
