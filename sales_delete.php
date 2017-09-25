<?php
//delete.php

$connect = mysqli_connect("gator2024.hostgator.com","emperorjun","5ymRrjce8\cW","emperorj_items");
$data = json_decode(file_get_contents("php://input"));

if(count($data) > 0)
{
	$id = $data->ID;
	
	$query = "DELETE FROM Sales_Records WHERE invoice_id = '$invoice_id'";
	if(mysqli_query($connect,$query))
	{
		echo "Data Deleted";
	}
	else
	{
		echo 'Error';
	}
}

?>
