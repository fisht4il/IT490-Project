<?php


require_once('apiFunctions.php');

//================

$url = 'https://www.alphavantage.co/query?function=LISTING_STATUS&apikey=demo';

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if (curl_errno($ch)){
	echo 'cUrl Error: ' . curl_errno($ch);
	exit;
}

curl_close($ch);

//TODO error message

$rows = str_getcsv($response, "\n");

$data = [];

foreach ($rows as $row){
	$columns = str_getcsv($row);
	
	$symbol = $columns[0];
	$name = $columns[1];
	$exch = $columns[2];
	$assetType = $columns[3];
	
	$insertQuery = "
	INSERT INTO stock_list 
		(symbol, name, exchange, type) 
		VALUES ('$symbol', '$name', '$exch', '$assetType')
		ON DUPLICATE KEY UPDATE
		symbol = VALUES(symbol)
	";	

	insertData($insertQuery);
}

?>
