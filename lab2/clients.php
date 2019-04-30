<?php

require_once "db.php";

$method = $_SERVER['REQUEST_METHOD'];

switch ($method)
{
	case 'GET':

		if(isset($_GET['id']))
		{
			$id=$_GET['id'];

			$query1="CALL `SelectClient`('$id');";
			$result1=mysqli_query($db, $query1) or die("Ошибка 1 " . mysqli_error($db));
			$row_cnt = mysqli_num_rows($result1);

			if($row_cnt<=0)
			{
				while($db->next_result()) $db->store_result();

				$query2="CALL `SelectAllClients`();";
				$result2=mysqli_query($db, $query2) or die("Ошибка 2" . mysqli_error($db));
			}
			else
			{
				PrintResult($result1);
			}
		}
		else
		{
			while($db->next_result()) $db->store_result();

			$query2="CALL `SelectAllClients`();";
			$result2=mysqli_query($db, $query2) or die("Ошибка 2" . mysqli_error($db));
			PrintResult($result2);
		}

		break;

	case 'POST':

		if(isset($_GET['name']))
		{
			$name=$_GET['name'];

			$query="CALL `InsertClient`('$name')";
			$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
		}

		break;

	case 'PUT':

		if(isset($_GET['id']) && isset($_GET['name']))
		{
			$id = $_GET['id'];
			$name = $_GET['name'];

			$query="CALL `UpdateClient`('$id', '$name')";
			$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
		}

		break;

	case 'DELETE':

		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
			$query="CALL `DeleteClient`('$id')";
			$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
		}
		
		break;

	default:		
		break;
}

function PrintResult($result){

	echo '<table border="1">
	<tr>
		  <th>ID</th>
		  <th>Name</th>
	</tr>
	';
	while($row = mysqli_fetch_array($result)){ 

		extract($row);

	    echo "<tr>
			<td>$id_client</td>
			<td>$name</td>
		 </tr>";				
	}
	echo '</table>';
}

mysqli_close($db);

?>