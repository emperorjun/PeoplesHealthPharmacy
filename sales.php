<!--file simplePHP.php -->

<HTML XMLns="http://www.w3.org/1999/xHTML"> 
  <head> 
    <title>PHP</title> 
  </head> 
  <body>
  <input readonly type="text" name="pn" id="pn"/>
  
  </body> 

<?php 

	$pn = '';
	$p_qty = '';
	$price = '';
	$print ='';
	
	if(isset($_GET['pn'])&& isset($_GET['p_qty'])&& isset($_GET['price']))
	{
		$id = $_GET['id'];
		$pn = $_GET['pn'];
		$p_qty = $_GET['p_qty'];
		$price = $_GET['price'];
	}	
	require_once("settings.php");
	
	if ($pn == '' || $p_qty == ''|| $price == '')
	{
		echo "<p>No field can be left empty</p>";
	}
	else if (is_numeric($pn))
	{
		echo "<p>The Product Name has to be ONLY a String value</p>";
	}
	else if ($p_qty < 0)
	{
		echo "<p>How can the Product QTY be less than 0?</p>";
	}
	else
	{
		$DBConnect = @mysqli_connect($host, $user, $pwd, $sql_db)
		or die("<p>Unable to connect to the database server.</p>". "<p>Error code ". mysqli_connect_errno().": ". mysqli_connect_error()). "</p>";
	
			
			$SQLstring = "insert into Product_Records(Product_Name,Product_QTY,Price) values ('$pn','$p_qty','$price')";
			$queryResult = @mysqli_query($DBConnect, $SQLstring)
			Or die ("<p>Unable to query the Product Table.</p>"."<p>Error code ". mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";
			$print ='y';
	mysqli_close($DBConnect);
	}
	
	if ($print =='y')
	{
		$DBConnect = @mysqli_connect($host, $user, $pwd, $sql_db)
		or die("<p>Unable to connect to the database server.</p>". "<p>Error code ". mysqli_connect_errno().": ". mysqli_connect_error()). "</p>";
		
		$SQLstring = "select * from Product_Records";
		$_queryResult = @mysqli_query($DBConnect, $SQLstring)
		Or die ("<p>Unable to query the inventory table.</p>"."<p>Error code ". mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";
		
		print_table($_queryResult);
		mysqli_close($DBConnect);
	}
	
	function print_table($_queryResult){
		echo "<hr></hr>";
		echo "<br></br>";
		echo "<h2>Content of Inventory Table</h2>";
		echo "<table width='100%' border='1'>";
		echo "<th>Product ID</th><th>Product Name</th><th>Product QTY</th><th>Price</th>";
		$row = mysqli_fetch_row($_queryResult);
	
		while ($row) {
			echo "<tr><td>{$row[0]}</td>";
			echo "<td>{$row[1]}</td>";
			echo "<td>{$row[2]}</td>";
			echo "<td>{$row[3]}</td></tr>";
			
			$row = mysqli_fetch_row($_queryResult);
		}
	echo "</table>";
	}
	
?>

</HTML>