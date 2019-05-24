<?php

require_once "db.php";

$method = $_SERVER['REQUEST_METHOD'];

$result;

switch ($method)
{
	case 'GET':

		if(isset($_GET['id_sel']))
		{
			$id = $_GET['id_sel'];
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

		if(isset($_GET['id_del']))
		{
			$id = $_GET['id_del'];
			
			$query="CALL `DeleteRequest`('$id')";
			$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
		}
		
		break;

	case 'POST':

		if(isset($_POST['id_ins']))
		{
			$client_id = $_POST['id_ins'];
			$query="CALL `InsertRequest`('$client_id')";
			$result=mysqli_query($db, $query) or die("Клиента не существует" . mysqli_error($db));
		}
		
		if(isset($_POST['id_rqst_upd']) && isset($_POST['id_clnt_upd']))
		{
			$id = $_POST['id_rqst_upd'];
			$client_id = $_POST['id_clnt_upd'];

			$query="CALL `UpdateRequest`('$id', '$client_id')";
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