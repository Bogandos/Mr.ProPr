<?php
require_once "SaveResult.php";

$get_string = json_decode(file_get_contents("http://www.mocky.io/v2/5c7db5e13100005a00375fda"));

$prepare_result= str_replace(" ", "_", $get_string->result);						
$result = json_encode($prepare_result, JSON_UNESCAPED_UNICODE);
SaveJson($result);

echo $result;

?>