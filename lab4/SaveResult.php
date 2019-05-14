<?php

function SaveJson($responseData)
{
		$filename='lab_4.json';
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

?>