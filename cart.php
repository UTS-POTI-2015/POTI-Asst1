<html>
<head>
	<title>Checkout Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="content">
		<div class="header">
			<h1>Shopping Cart</h1>
		</div>

		<div id="body">
		<?php
			$product_id = $_REQUEST['product_id'];
			$quantity_to_purchase = $_REQUEST['quantity_to_purchase'];
			echo "product_id is " . $product_id;
			echo "<br>";
			echo "quantity_to_purchase is " . $quantity_to_purchase;

	        $link = mysql_connect("rerun","potiro","pcXZb(kL");
	        if (!$link)
	           die("Could not connect to Server");
	        mysql_select_db("poti",$link);

	        $query_string = "select * from products where product_id = $product_id";
	        $result = mysql_query($query_string);

	        $num_rows = mysql_num_rows($result);
	        if ($num_rows > 0 ) {

	            print "<table>";
	            print "<tr>\n<th>Product Name</th><th>Unit Quantity</th><th>Unit Price</th><th>Quantity</th><th>Line Total</th></tr>";
	            while ( $a_row = mysql_fetch_assoc($result) ) {
	                 print "<tr>\n";
	                 print "<td>".$a_row['product_name']."</td>";
	                 print "<td>".$a_row['unit_quantity']."</td>";
	                 print "<td>".$a_row['unit_price']."</td>";
	                 print "<td>".$quantity_to_purchase."</td>";
	                 print "<td>".$a_row['unit_price']*$quantity_to_purchase."</td>";
	                 print "</tr>";
	            }
	            print "<tr><td colspan='5' class='button'>Total Price for shopping: $</td></tr>";
	            print "</table>";
	        }
	        mysql_close($link);
	    ?>		

			<form action="checkout.php">
			<table>
				<tr>
					<td class='button'>
						<input type="submit" name="checkout" value="Checkout">
					</td>
					<td class='button'>
						 <input type="reset" name="Clear" value="Clear">
					</td>
				</tr>
			</table>
			</form>

		</div>
	</div>

</body>
</html>