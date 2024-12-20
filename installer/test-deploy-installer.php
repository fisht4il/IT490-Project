#!/usr/bin/php
<?php
require '../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dbHost = $_ENV['deployHost'];
$dbUser = $_ENV['deployUser'];
$dbPass = $_ENV['deployPass'];
$dbName = $_ENV['deployName'];


require_once('../path.inc');
//require_once('../get_host_info.inc');
require_once('../RabbitMQ/rabbitMQLib.inc');
//$config = include('dbClient.php');

date_default_timezone_set('America/New_York');

if ($argc != 2){
        echo "something wrong: wrong bundler argument!\n";
        exit(1);
}


//todo look through and find most recent new


$bundleName = $argv[1];

try {
	global $dbHost;
        global $dbUser;
        global $dbPass;
        global $dbName;

	$dbLogin = "mysql:host=$dbHost;dbname=$dbName";

        $pdo = new PDO($dbLogin, $dbUser, $dbPass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 	
	$stmt = $pdo->prepare("SELECT bundle_name, version FROM bundles WHERE bundle_name = :name AND status = 'new' ORDER BY version DESC LIMIT 1");
	$stmt->bindParam(':name', $bundleName);
	$stmt->execute();
	$response = $stmt->fetch(PDO::FETCH_ASSOC);
	//$version = $response['version'];
   	$version = number_format($response['version'], 1);


	//TODO change filepath here if it's changed
	$tarballName = '../bundles/' . $bundleName . '_' . $version . '.tar.gz';
	//$encodedName = $bundleName . '_' . $version . '.b64';
        //$encodedFile = base64_encode($tarballName);
	// ignore $bundleFile = $bundleName . '_' . $response['version'] . '.tar.gz'



	$request = [
        'type' => "bundler",
        'name' => $bundleName,
        'version' => $version,
        'tarball' => file_get_contents($tarballName)
	];

	require_once('test-installer.php');
	installer($request);
} catch (Exception $e){
	echo "ERROR: " . $e->getMessage();
}
//$bundleFile = $argv[2];



//TODO implement rabbitmq testing betweem VMs, using one vm is not working
//$client = new RabbitMQClient("testRabbitMQ.ini", "dev-deploy");
//$response = $client->send_request($request);

//require_once('test-installer.php');
//installer($request);

//echo json_decode($response);


?>


