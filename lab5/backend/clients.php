<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Credentials: true");

require_once "db.php";

$method = $_SERVER['REQUEST_METHOD'];

switch ($method)
{
	case 'GET':

		if(isset($_GET['id_sel']))
		{
			$id=$_GET['id_sel'];

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
		
		if(isset($_GET['id_del']))
		{
			$id = $_GET['id_del'];
			$query="CALL `DeleteClient`('$id')";
			$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
		}

		break;

	case 'POST':

		if(isset($_POST['name_ins']))
		{
			$name=$_POST['name_ins'];

			$query="CALL `InsertClient`('$name')";
			$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
		}

		if(isset($_POST['id_upd']) && isset($_POST['name_upd']))
		{
			$id = $_POST['id_upd'];
			$name = $_POST['name_upd'];

			$query="CALL `UpdateClient`('$id', '$name')";
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