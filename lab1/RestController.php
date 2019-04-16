<?php
require_once("RestHandler.php");

$view = '';

if(isset($_GET["view"]))
{
	$view = $_GET["view"];
}

switch($view){

	case "path":
		$restHandler = new RestHandler();
		$restHandler->getPathParameter($_GET["id"]);
		break;
		
	case "quadratic":
		$restHandler = new RestHandler();
		$restHandler->getQuadratic($_GET["a"], $_GET["b"], $_GET["c"]);
		break;

	case "date":
		$restHandler = new RestHandler();
		$restHandler->getWeekday($_GET["date"]);
		break;

	case "fibonacci":
		$restHandler = new RestHandler();
		$restHandler->getFibonacci($_GET["id"]);
		break;

	case "region":
		$restHandler = new RestHandler();
		$restHandler->getRegion($_GET["id"]);
		break;

	case "" :
		break;
}
?>
