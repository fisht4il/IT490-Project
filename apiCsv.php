<?php
//work based on previous from this class, 
//as well as referencing from php.net/manual/en/pdo.constants.php
//(side note, why do stocks have to use names with characters?! took too long to figure out the syntax error!!)

require_once('apiFunctions.php');

//================

global $apiKey;

$url = 'https://www.alphavantage.co/query?function=LISTING_STATUS&apikey=' . $apiKey;

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

global $pdo;

foreach ($rows as $row){
	$columns = str_getcsv($row);
	
	$symbol = $columns[0];
	if (strlen($symbol) > 10){
		continue;
		//10+char symbols are niche and will not be used for this project
	}


	$name = $columns[1];
	$exch = $columns[2];
	$assetType = $columns[3];
	
	$insertQuery = "
	INSERT IGNORE INTO stock_list 
		(symbol, name, exchange, type) 
		VALUES (:symbol, :name, :exch, :assetType)
	";	


	try{
		$stmt = $pdo->prepare($insertQuery);
		
		$stmt->bindParam(':symbol', $symbol, PDO::PARAM_STR);
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->bindParam(':exch', $exch, PDO::PARAM_STR);
		$stmt->bindParam(':assetType', $assetType, PDO::PARAM_STR);

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

?>
