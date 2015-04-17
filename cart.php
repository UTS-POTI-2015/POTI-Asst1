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
			$quantity_to_purchase = ltrim($_REQUEST['quantity_to_purchase'], '0');
			// echo "product_id is " . $product_id;
			// echo "<br>";
			// echo "quantity_to_purchase is " . $quantity_to_purchase;

			session_start();
			if(!is_array($_SESSION['cart'])) {
				$_SESSION['cart']=array();
			}
			array_push($_SESSION['cart'],array($product_id => $quantity_to_purchase));
			// echo "SESSION['cart'] size is " . count($_SESSION['cart'])."\n";
			// foreach ($_SESSION['cart'] as $item) {
			// 	foreach ($item as $key => $value) {
			// 	echo "product_id is $key\n";
			// 	echo "quantity_to_purchase is $value\n";
			// 	}
			// }

	        $link = mysql_connect("rerun","potiro","pcXZb(kL");
	        if (!$link)
	           die("Could not connect to Server");
	        mysql_select_db("poti",$link);
		?>	

		<form name="cart" action="cart.php">
		<?php
            print "<table>";
            print "<tr>\n<th>Product Name</th><th>Unit Quantity</th><th>Unit Price</th><th>Quantity</th><th>Line Total</th></tr>";

		 	if(is_array($_SESSION['cart'])){
		 		$totalPrice = 0;
				foreach ($_SESSION['cart'] as $item) {
					foreach ($item as $key => $value) {
				        $query_string = "select * from products where product_id = $key";
				        $result = mysql_query($query_string);

				        $num_rows = mysql_num_rows($result);
				        if ($num_rows > 0 ) {
				            while ( $a_row = mysql_fetch_assoc($result) ) {
				                 print "<tr>\n";
				                 print "<td>".$a_row['product_name']."</td>";
				                 print "<td>".$a_row['unit_quantity']."</td>";
				                 print "<td>".$a_row['unit_price']."</td>";
				                 print "<td>".$value."</td>";
				                 print "<td>".$a_row['unit_price']*$value."</td>";
				                 print "</tr>";
				                 $totalPrice += $a_row['unit_price']*$value;
				            }			         			
					 	}
					}
				}
	        }

	        print "<tr><td colspan='5' class='button'>Total Price for shopping: $ ".$totalPrice."</td></tr>";
	        print "<tr><td colspan='4' class='button'><input type='submit' value='Checkout'>";
			print "<td class='button'><input type='button' value='Clear' onclick='document.cart.reset();return false;''></tr>";	       
            print "</table>";

        	mysql_close($link);
	    ?>
		</form>

		</div>
	</div>

</body>
</html>