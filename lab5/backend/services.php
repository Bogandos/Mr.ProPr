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

			$query1="CALL `SelectService`('$id');";
			$result1=mysqli_query($db, $query1) or die("Ошибка 1 " . mysqli_error($db));
			$row_cnt = mysqli_num_rows($result1);

			if($row_cnt<=0)
			{
				while($db->next_result()) $db->store_result();

				$query2="CALL `SelectAllServices`();";
				$result2=mysqli_query($db, $query2) or die("Ошибка 2" . mysqli_error($db));
				PrintResult($result2);
			}
			else
			{
				PrintResult($result1);
			}
		}

	if(isset($_GET['id_del']))
	{
		$id = $_GET['id_del'];

		$query="CALL `DeleteService`('$id')";
		$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
	}

	break;

	case 'POST':

		if(isset($_POST['name_ins']) && isset($_POST['price_ins']))
		{
			$name=$_POST['name_ins'];
			$price=$_POST['price_ins'];

			$query="CALL `InsertService`('$name', '$price')";
			$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
		}

		if(isset($_POST['id_upd']) || isset($_POST['name_upd']) || isset($_POST['price_upd']))
		{
			$id_upd = $_POST['id_upd'];
			$name_upd = $_POST['name_upd'];
			$price_upd=$_POST['price_upd'];

			if(isset($_POST['id_upd']) && isset($_POST['name_upd']) && isset($_POST['price_upd']))
			{
				$query="CALL `UpdateService3`('$id_upd', '$name_upd', '$price_upd')";
				$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
			}
			else if(isset($_POST['id_upd']) && isset($_POST['name_upd']))
			{
				$query="CALL `UpdateService1`('$id_upd', '$name_upd')";
				$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
			}
			else if(isset($_POST['id_upd']) && isset($_POST['price_upd'])) 
			{
				$query="CALL `UpdateService2`('$id_upd', '$price_upd')";
				$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
			}
			
			
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
		  <th>Price</th>
	</tr>
	';
	while($row = mysqli_fetch_array($result)){ 

		extract($row);

	    echo "<tr>
			<td>$id_service</td>
			<td>$name</td>
			<td>$price</td>
		 </tr>";				
	}
	echo '</table>';
}

mysqli_close($db);

?>
