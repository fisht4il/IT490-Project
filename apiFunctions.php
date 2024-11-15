<?php
//This file is based on previous api work from this course
//and is also based on the official php documentation from alphavantage.co/documentation

require 'vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv =  Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['API_KEY']; //global

/* this works
$json = file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=IBM&apikey=' . $apiKey);

$data = json_decode($json,true);

print_r($data);
 */

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~`
//
//


//=====
//seriesInterval
//=====
function seriesInterval($duration, $stockSym){
	global $apiKey;

	$json = file_get_contents(
		'https://www.alphavantage.co/query?function=TIME_SERIES_' . $duration . 
		'&symbol=' . $stockSym  . 
		'&apikey=' . $apiKey
	);
	$data = json_decode($json, true);

	if (!empty($data)){
		return $data; // todo do the function below, not just returning here

		/* TODO implement this so that you can prepare data to insert into mysql db

		foreach ($data as $entry){
			//TODO
		}

		 */
	}
}

//=====
//seriesIntraday
//=====
/* TODO implement this
 
function seriesIntraday($stockSym, //TODO theres options for outputsize and month, I assume check depending on if empty or not


 */

//=====
//insertData
//=====
//all the functions will call this at end to have $data inserted into table
/*TODO implement this

function insertData($insertQuery){
	//db stuff here

	//pdo stuff here

	//close everything at the end

}

 */


#==========
//TODO when making the front-end interface, maybe stock symbols should be a filterable drop-down?
//to avoid annoyance of repeated "invalid stock symbol" errors
//remember to ignore capitalization if implementing this filtering system
//(e.g. typing characters narrows down the listed drop-down options)

function requestApi($request){
	$stockSym = $request['stock_symbol'];
	//$accessToken = getAccessToken($apiKey, $apiSecret);
	if ($stockSym){
		switch ($request['type']){
			case 'DAILY':
                                $results = seriesInterval($request['type'], $stockSym);
                                break;
			case 'WEEKLY':
				$results = seriesInterval($request['type'], $stockSym);
				break;
			case 'MONTHLY':
				$results = seriesInterval($request['type'], $stockSym);
	  			break;
		}
		print_r($results);
	} else {
		echo "FAILED: NO STOCK SYMBOL GIVEN!\n";
	}
}



?>
~          
