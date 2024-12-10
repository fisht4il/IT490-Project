<?php

require_once('../apiFunctions.php');
require '../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv =  Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['API_KEY']; //global

$dbHost = $_ENV['DB_HOST'];
$dbUser = $_ENV['DB_USER'];
$dbPass = $_ENV['DB_PASS'];
$dbName = $_ENV['DB_API'];


if ($argc < 2 || $argv[1] == null){
        echo "Invalid or Missing Argument\nPlease fix your CRON job !!\n";
        exit(1);
} //else

$arg = $argv[1];


try{
        $dbLogin = "mysql:host=$dbHost;dbname=$dbName";
        $pdo = new PDO($dbLogin, $dbUser, $dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
        echo "Exception " . $e->getMessage();
        exit();
} //note: do not close conn here, we will close below instead for this specific file
//normally, you should have a 'finally' statement that always closes stmt and conn to avoid issues


//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//=====
//updatePopular
//=====

function updatePopular($pdo, $stockSym){
	try {
		$sql = "INSERT IGNORE INTO popular_stocks (symbol, name, exchange, type)
			SELECT symbol, name, exchange, type
			FROM stock_list
			WHERE symbol IN ('$stockSym')";
		$stmt = $pdo->query($sql);
	
	} catch (PDOException$e){
        echo "[ERROR] while fetching from stock_list: " . $e->getMessage(). "\n";
	} finally {
        	if ($stmt){
                	$stmt=null;
        	}
        	$conn=null;
	}
	
}



//=====
//checking arguments
//=====

function checkArg($pdo, $stockSym){
	global $arg;
	switch($arg){
        	case 'dailyPrices':
			$request = array(
                	'type' => 'DAILY', //options: DAILY, WEEKLY, MONTHLY
                	'stock_symbol' => $stockSym
        		);
        		requestApi($request);
                	break;
        	case 'quotes':
			$request = array(
				'type' => 'QUOTE',
				'stock_symbol' => $stockSym
			);
			requestApi($request);
			break;
		case 'popular':
			updatePopular($pdo, $stockSym);
			break;
        	default:
                	echo "Invalid Argument\nFIX YOUR CRON JOB !!!\n";
                	exit(1);
	}

}

//=====
//this is the main function of the file
//=====
try {
//	$sql = "SELECT symbol FROM stock_list";
	$sql = "SELECT symbol FROM popular_stocks";
	$stmt = $pdo->query($sql);

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$stockSym = $row['symbol'];
		checkArg($pdo, $stockSym);

	}
} catch (PDOException$e){
	echo "[ERROR] while fetching from stock_list: " . $e->getMessage(). "\n";
} finally {
	if ($stmt){
		$stmt=null;	
	}
	$conn=null;
}




?>
