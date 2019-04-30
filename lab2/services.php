<?php

require_once "db.php";

$method = $_SERVER['REQUEST_METHOD'];

switch ($method)
{
	case 'GET':

		if(isset($_GET['id']))
		{
			$id=$_GET['id'];

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
		else
		{
			while($db->next_result()) $db->store_result();

			$query2="CALL `SelectAllServices`();";
			$result2=mysqli_query($db, $query2) or die("Ошибка 2" . mysqli_error($db));
			PrintResult($result2);
		}

		break;

	case 'POST':

		if(isset($_GET['name']) && isset($_GET['price']))
		{
			$name=$_GET['name'];
			$price=$_GET['price'];

			$query="CALL `InsertService`('$name', '$price')";
			$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
		}

		break;


	case 'PUT':

		if(isset($_GET['id']) || isset($_GET['name']) || isset($_GET['price']))
		{
			$id = $_GET['id'];
			$name = $_GET['name'];
			$price=$_GET['price'];

			if(isset($_GET['id']) && isset($_GET['name']) && isset($_GET['price']))
			{
				$query="CALL `UpdateService3`('$id', '$name', '$price')";
				$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
			}
			else if(isset($_GET['id']) && isset($_GET['name']))
			{
				$query="CALL `UpdateService1`('$id', '$name')";
				$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
			}
			else if(isset($_GET['id']) && isset($_GET['price'])) 
			{
				$query="CALL `UpdateService2`('$id', '$price')";
				$result=mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
			}
			
			
		}

		break;

	case 'DELETE':

		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
			echo $id;
			$query="CALL `DeleteService`('$id')";
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