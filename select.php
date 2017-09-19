<?php
//select.php
$connect = mysqli_connect("gator2024.hostgator.com","emperorjun","5ymRrjce8\cW","emperorj_items");
$output = array();

$query = "SELECT * FROM Product_Records";

$result = mysqli_query($connect, $query);

if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_array($result))
	{
		$output[] = $row;
	}
	echo json_encode($output);
}
?>