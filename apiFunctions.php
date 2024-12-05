<?php
//This file is based on previous api work from this course
//and is also based on the official php documentation from alphavantage.co/documentation

require 'vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv =  Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['API_KEY']; //global

$dbHost = $_ENV['DB_HOST'];
$dbUser = $_ENV['DB_USER'];
$dbPass = $_ENV['DB_PASS'];
$dbName = $_ENV['DB_API'];

try{
        $dbLogin = "mysql:host=$dbHost;dbname=$dbName";
        $pdo = new PDO($dbLogin, $dbUser, $dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
        echo "Exception " . $e->getMessage();
        exit();
}



/* this works
$json = file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=IBM&apikey=' . $apiKey);

$data = json_decode($json,true);

print_r($data);
 */

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~`
//
//

//=====
//quoteEndpoint
//=====
function quoteEndpoint($stockSym){
	global $apiKey;

	$json = file_get_contents(
                'https://www.alphavantage.co/query?function=GLOBAL_QUOTE' . 
                '&symbol=' . $stockSym  .
                '&apikey=' . $apiKey
        );
        $data = json_decode($json, true);


	if (!empty($data)){
		//TODO stuff to get data parse
		$globalQuote = $data['Global Quote'];
		
		$symbol = $stockSym;
		$open = $globalQuote['02. open'];
		$high = $globalQuote['03. high'];
		$low = $globalQuote['04. low'];
		$price = $globalQuote['05. price'];
		$volume = $globalQuote['06. volume'];
		$ltd = $globalQuote['07. latest trading day'];
		$prevClose = $globalQuote['08. previous close'];
		$changePoint = $globalQuote['09. change'];
		$changePercent = $globalQuote['10. change percent'];
		
		$insertQuery = "
		INSERT INTO stock_quotes
		(symbol, open, high, low, price, volume, latest_trading_day, prev_close, change_point, change_percent) 
		VALUES 
		('$symbol', '$open', '$high', '$low', '$price', '$volume', '$ltd', '$prevClose', '$changePoint', '$changePercent')
		ON DUPLICATE KEY UPDATE 
		open = VALUES(open),
		high = VALUES(high),
		low = VALUES(low),
		price = VALUES(price),
		volume = VALUES(volume),
		latest_trading_day = VALUES(latest_trading_day),
		prev_close = VALUES(prev_close),
		change_point = VALUES(change_point),
		change_percent = VALUES(change_percent)
		";       
                insertData($insertQuery);
                


        }


}


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
              //return $data; // this line is for testing console-output

                        $symbol = $stockSym;
                        //$lastRefreshed = $data['Meta Data']['3. Last Refreshed'];
			$timeSeries = $data['Time Series (Daily)'];
                        $dates = array_keys($timeSeries);

                for ($i = 0 ; $i < count($dates) ; $i++){
                        $date = $dates[$i];
	
                        $open = $timeSeries[$date]['1. open'];
                        $high = $timeSeries[$date]['2. high'];
                        $low = $timeSeries[$date]['3. low'];
                        $close = $timeSeries[$date]['4. close'];
                        $volume = $timeSeries[$date]['5. volume'];
                        $insertQuery = "
                                INSERT IGNORE INTO stock_prices 
                                (symbol, date, open, high, low, close, volume) 
                                VALUES 
                                ('$symbol', '$date', '$open', '$high', '$low', '$close', '$volume')
				";
                        insertData($insertQuery);
                }


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
function insertData($insertQuery){
	global $pdo;
        try{
                $stmt = $pdo->prepare($insertQuery);
                $stmt->execute();

        } catch (PDOException $e) {
                echo "Exception " . $e->getMessage();
                exit();
        } finally {
                if ($stmt){
                        $stmt=null;
                }
                $conn=null;
        }

}



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
			case 'QUOTE':
				$results = quoteEndpoint($stockSym);
				break;
		}
		print_r($results);
	} else {
		echo "FAILED: NO STOCK SYMBOL GIVEN!\n";
	}
}



?>
~          
