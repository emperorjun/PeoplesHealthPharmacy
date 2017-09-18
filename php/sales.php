<!--file simplePHP.php -->

<HTML XMLns="http://www.w3.org/1999/xHTML"> 
  <head> 
    <title>PHP</title> 
  </head> 
  <body>
  <H1>Peoples Health Pharmacy</H1>
  <hr></hr>
  <h2>Adding a New Record</h2>
  <form>
		<label>Product ID:  <input type="text" name="id"> </label>
 	    <label><br></br>Product Name: <input type="text" name="pn"></label>
		<label><br></br>Product QTY: <input type="text" name="p_qty"></label>
		<label><br></br>Product Order ID: <input type="text" name="p_ord_id"></label>
		<label><br></br>Price: <input type="text" name="price"></label>
		<label><br></br>InStock QTY: <input type="text" name="in_stock_qty"></label>
		<br></br><input type="submit" value="Add" />
  </form>
  
  <a href="task_c.php"><h2>Click Here to Make a Selection</h2></a>
  </body> 

<?php 
	$id = '';
	$pn = '';
	$p_qty = '';
	$p_ord_id = '';
	$price = '';
	$in_stock_qty = '';
	$print ='';
	
	if(isset($_GET['id']) && isset($_GET['pn'])&& isset($_GET['p_qty'])&& isset($_GET['p_ord_id'])&& isset($_GET['price'])&& isset($_GET['in_stock_qty']))
	{
		$id = $_GET['id'];
		$pn = $_GET['pn'];
		$p_qty = $_GET['p_qty'];
		$p_ord_id = $_GET['p_ord_id'];
		$price = $_GET['price'];
		$in_stock_qty = $_GET['in_stock_qty'];
	}	
	require_once("settings.php");
	
	if ($id == '' || $pn == '' || $p_qty == ''|| $p_ord_id == ''|| $price == ''|| $in_stock_qty =='')
	{
		echo "<p>No field can be left empty</p>";
	}
	else if ((!(is_numeric ($id)) && $id != '')||(!(is_numeric ($p_ord_id)) && $p_ord_id != ''))
	{
		echo "<p>The Product ID & Product Order ID has to be ONLY a numeric value</p>";
	}
	else if (is_numeric($pn))
	{
		echo "<p>The Product Name has to be ONLY a String value</p>";
	}
	else if ($p_qty < 0 || $in_stock_qty < 0)
	{
		echo "<p>How can the Product QTY be less than 0?</p>";
	}
	else
	{
		$DBConnect = @mysqli_connect($host, $user, $pwd, $sql_db)
		or die("<p>Unable to connect to the database server.</p>". "<p>Error code ". mysqli_connect_errno().": ". mysqli_connect_error()). "</p>";
	
		if ($id != '' && $pn != '' && $p_qty != ''&& $p_ord_id != ''&& $price != ''&& $in_stock_qty != '')
		{	
			$SQLstring = "insert into Product_Records(ID,Product_Name,Product_QTY,Product_Order_ID,Price,InStock_QTY) values ('$id','$pn','$p_qty','$p_ord_id','$price','$in_stock_qty')";
			$queryResult = @mysqli_query($DBConnect, $SQLstring)
			Or die ("<p>Unable to query the Product Table.</p>"."<p>Error code ". mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";
			$print ='y';
		}
		else 
		{
			echo "<p>ERROR!</p>";
		}
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
		echo "<th>Product ID</th><th>Product Name</th><th>Product QTY</th><th>Product Order ID</th><th>Price</th><th>InStock QTY</th>";
		$row = mysqli_fetch_row($_queryResult);
	
		while ($row) {
			echo "<tr><td>{$row[0]}</td>";
			echo "<td>{$row[1]}</td>";
			echo "<td>{$row[2]}</td>";
			echo "<td>{$row[3]}</td>";
			echo "<td>{$row[4]}</td>";
			echo "<td>{$row[5]}</td></tr>";
			
			$row = mysqli_fetch_row($_queryResult);
		}
	echo "</table>";
	}
	
?>

</HTML>