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
			$product_name = $_REQUEST['product_name'];
			$unit_quantity = $_REQUEST['unit_quantity'];
			$unit_price = $_REQUEST['unit_price'];
			$quantity_to_purchase = ltrim($_REQUEST['quantity_to_purchase'], '0');
			// echo "product_id is " . $product_id . "<br>";
			// echo "product_name is " . $product_name . "<br>";
			// echo "unit_quantity is " . $unit_quantity . "<br>";
			// echo "unit_price is " . $unit_price . "<br>";
			// echo "quantity_to_purchase is " . $quantity_to_purchase . "<br>";

			session_start();
			if(!is_array($_SESSION['cart'])) {
				$_SESSION['cart']=array();
			}

			$item_array=array('product_id' => $product_id,
							 'product_name' => $product_name,
							 'unit_quantity' => $unit_quantity,
							 'unit_price' => $unit_price,
							 'quantity_to_purchase' => $quantity_to_purchase,
							 'line_totle' => $unit_price * $quantity_to_purchase);

			array_push($_SESSION['cart'], $item_array);
		?>	

		<form name="cart" action="cart.php">
		<?php
            print "<table>";
            print "<tr>\n<th>Product Name</th><th>Unit Quantity</th><th>Unit Price</th><th>Quantity</th><th>Line Total</th></tr>";

		 	if(is_array($_SESSION['cart'])){
		 		$totalPrice = 0;
		 		
				foreach ($_SESSION['cart'] as $item) {
					print "<tr>\n";
					foreach ($item as $key => $value) {
						if ($key != 'product_id')
				        	print "<td>".$value."</td>";
				        if ($key == 'line_totle')				                
				            $totalPrice += $value;       								 	
					}
				 	print "</tr>";
				}
	        }
	        print "<tr><td colspan='5' class='button'>Total Price for shopping: $ ".$totalPrice."</td></tr>";
	        print "<tr><td colspan='4' class='button'><input type='submit' value='Checkout'>";
			print "<td class='button'><input type='button' value='Clear' onclick='document.cart.reset();return false;''></tr>";	       
            print "</table>";
	    ?>
		</div>
	</div>

</body>
</html>