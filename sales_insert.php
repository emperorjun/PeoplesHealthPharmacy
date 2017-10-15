<?php
//sales_insert.php

$connect = mysqli_connect("gator2024.hostgator.com","emperorjun","5ymRrjce8\cW","emperorj_items");
$data = json_decode(file_get_contents("php://input"));

if(count($data) > 0)
{
	
	$Purchase_Date = mysqli_real_escape_string($connect, $data->Purchase_Date);
	$Purchase_QTY = mysqli_real_escape_string($connect, $data->Purchase_QTY);
	$Product_ID = mysqli_real_escape_string($connect, $data->product_ID);
	$Total_Price = ""; /*Dont include this*/
	$Price = "5";
	
	$query = "SELECT Price FROM Product_Records WHERE ID='$Product_ID' limit 1";
	$result = mysqli_query($connect,$query);
	$Price = mysqli_fetch_object($result) -> Price;
	$Total_Price = $Purchase_QTY *  $Price;	
	
	$query = "INSERT INTO Sales_Record(Purchase_Date,Purchase_QTY,Total_Price,Product_ID) VALUES 	('$Purchase_Date','$Purchase_QTY','$Total_Price','$Product_ID')";
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
