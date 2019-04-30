<?php

require_once "db.php";

$method = $_SERVER['REQUEST_METHOD'];

$result;

switch ($method)
{
	case 'GET':

		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
			$query1="CALL `SelectRequest`('$id');";
			$result1=mysqli_query($db, $query1) or die("Ошибка 1 " . mysqli_error($db));
			$row_cnt = mysqli_num_rows($result1);

			if($row_cnt<=0)
			{
				while($db->next_result()) $db->store_result();

				$query2="CALL `SelectAllRequests`();";
				$result2=mysqli_query($db, $query2) or die("Ошибка 2" . mysqli_error($db));

				PrintResult1($result2);
			}
			else
			{	
				while($db->next_result()) $db->store_result();

				$query3="CALL `SelectRequestDetails`('$id');";
				$result3=mysqli_query($db, $query3) or die("Ошибка 1 " . mysqli_error($db));

				PrintResult1($result1);
				PrintResult2($result3);
			}
		}
		else
		{
			while($db->next_result()) $db->store_result();

			$query2="CALL `SelectAllRequests`();";
			$result2=mysqli_query($db, $query2) or die("Ошибка 2" . mysqli_error($db));
			PrintResult1($result2);
		}

		break;

	case 'POST':

		if(isset($_GET['client_id']))
		{
			$client_id = $_GET['client_id'];
			$query="CALL `InsertRequest`('$client_id')";
			$result=mysqli_query($db, $query) or die("Клиента не существует" . mysqli_error($db));
		}
		if (isset($_GET['request_id']) && isset($_GET['service_id']) && isset($_GET['count']))
		{
			$request_id = $_GET['request_id'];
			$service_id = $_GET['service_id'];
			$count = $_GET['count'];

			$query="CALL `InsertRequestDetails`('$request_id', '$service_id', '$count')";
			$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
		}

		break;

	case 'PUT':

		if(isset($_GET['id']) && isset($_GET['client_id']))
		{
			$id = $_GET['id'];
			$client_id = $_GET['client_id'];

			$query="CALL `UpdateRequest`('$id', '$client_id')";
			$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
		}

		break;

	case 'DELETE':

		if(isset($_GET['request_id']) && isset($_GET['service_id']))
		{
			$request_id = $_GET['request_id'];
			$service_id = $_GET['service_id'];

			$query="CALL `DeleteRequestDetails`('$request_id', '$service_id')";
			$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
		}
		else if(isset($_GET['id']))
		{
			$id = $_GET['id'];
			
			$query="CALL `DeleteRequest`('$id')";
			$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
		}

		break;

	default:

		break;
}

function PrintResult1($result){

	echo '<table border="1">
	<tr>
		  <th>ID заявки</th>
		  <th>ID клиента</th>
		  <th>ФИО клиента</th>
	</tr>
	';
	while($row = mysqli_fetch_array($result)){ 

		extract($row);

	    echo "<tr>
			<td>$id_request</td>
			<td>$client_id</td>
			<td>$name</td>
		 </tr>";				
	}
	echo '</table>';
}

function PrintResult2($result){

	echo '<table border="1">
	<tr>
		  <th>ID сервиса</th>
		  <th>Название</th>
		  <th>Количество</th>
	</tr>
	';
	while($row = mysqli_fetch_array($result)){ 

		extract($row);

	    echo "<tr>
			<td>$id_service</td>
			<td>$name</td>
			<td>$count</td>
		 </tr>";				
	}
	echo '</table>';
}

mysqli_close($db);

?>