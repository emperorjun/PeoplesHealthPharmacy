<?php
//insert.php

$connect = mysqli_connect("gator2024.hostgator.com","emperorjun","5ymRrjce8\cW","emperorj_items");
$data = json_decode(file_get_contents("php://input"));

if(count($data) > 0)
{
	$Product_Name = mysqli_real_escape_string($connect, $data->productName);
	$Product_QTY = mysqli_real_escape_string($connect, $data->productQuantity);
	$Price = mysqli_real_escape_string($connect, $data->productPrice);
	
	
	$query = "INSERT INTO Sales_Records(Invoice_ID,Purchase_Date,Purchase_QTY,Total_Price,ID) VALUES ('$Invoice_ID',$Purchase_Date,$Purchase_QTY,$Total_Price,$ID)";
	if(mysqli_query($connect,$query))
	{
		echo "Data Inserted...";
	}
	else
	{
		echo 'Error';
	}
}

?>