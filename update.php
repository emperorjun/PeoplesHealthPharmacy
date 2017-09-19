<?php
//update.php

$connect = mysqli_connect("gator2024.hostgator.com","emperorjun","5ymRrjce8\cW","emperorj_items");
$data = json_decode(file_get_contents("php://input"));

if(count($data) > 0)
{
	$Product_QTY = mysqli_real_escape_string($connect, $data->productQuantity);
	$id = $data->ID;
	
	$query = "UPDATE Product_Records SET Product_QTY = '$Product_QTY' WHERE id = '$id'";
	if(mysqli_query($connect,$query))
	{
		echo "Data updated...";
	}
	else
	{
		echo 'Error';
	}
}

?>