<?php
//This file is based on previous api work from this course
//and is also based on the official php documentation from alphavantage.co/documentation

require 'vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv =  Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['API_KEY'];


$json = file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=IBM&apikey=' . $apiKey);

$data = json_decode($json,true);

print_r($data);

exit;
?>
~          
