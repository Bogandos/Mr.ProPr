<?php
header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header('Content-Type: application/json');
header('Accept: application/json');
$_SERVER['HTTP_ACCEPT']='application/json';

require_once("SimpleRest.php");
require_once("MyFunctions.php");
		
class RestHandler extends SimpleRest {

	public function getPathParameter($id){

		$pathParameter = new MyFunctions();
		$rawData = $pathParameter->getPathParameter($id);

		$prepareResult = new RestHandler();
		$result=$prepareResult->getPrepareResult($rawData);
	
	}

	public function getQuadratic($a, $b, $c){

		$quadratic = new MyFunctions();
		$rawData = $quadratic->getQuadratic($a, $b, $c);

		$prepareResult = new RestHandler();
		$result=$prepareResult->getPrepareResult($rawData);

	}

	public function getWeekday($date){

		$quadratic = new MyFunctions();
		$rawData = $quadratic->getWeekday($date);

		$prepareResult = new RestHandler();
		$result=$prepareResult->getPrepareResult($rawData);

	}

	public function getFibonacci($id){

		$fibonacci = new MyFunctions();
		$rawData = $fibonacci->getFibonacci($id);

		$prepareResult = new RestHandler();
		$result=$prepareResult->getPrepareResult($rawData);
	
	}

	public function getRegion($id){

		$region = new MyFunctions();
		$rawData = $region->getRegion($id);

		$prepareResult = new RestHandler();
		$result=$prepareResult->getPrepareResult($rawData);
	
	}

	public function getPrepareResult($rawData){

		if(empty($rawData)){

			$statusCode = 404;
			$rawData = array('error' => 'No mobiles found!');	

		} 
		else{

			$statusCode = 200;

		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($requestContentType,'application/json')!==false){

			$response = $this->encodeJson($rawData);
			echo $response;
		}
	}

	public function encodeJson($responseData){

		$filename='lab_1.json';
		$url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		$answer=array();

		$answer[]=array(
			'url' => $url,
			'response' => $responseData,
			'method' => $_SERVER['REQUEST_METHOD'],);

		$jsonResponse = json_encode($answer, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

		file_put_contents($filename, $jsonResponse.'\n', FILE_APPEND | LOCK_EX);
		return $jsonResponse;		

	}
}
?>