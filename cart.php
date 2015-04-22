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
			$action = $_REQUEST['action'];
			switch ($action) {
				case 'Add':
					$product_id = $_REQUEST['product_id'];
					$product_name = $_REQUEST['product_name'];
					$unit_quantity = $_REQUEST['unit_quantity'];
					$unit_price = $_REQUEST['unit_price'];
					$quantity_to_purchase = ltrim($_REQUEST['quantity_to_purchase'], '0');

					session_start();
					// print "Number of Items in the session = ".sizeof($_SESSION['cart'])." <br>";
					// print "is_array(SESSION[cart]) is ".(string)is_array($_SESSION['cart'])." <br>";
					
					if(is_null($_SESSION['cart'])) {
						$_SESSION['cart']=array();
					}

					$item_array=array('product_id' => $product_id,
									  'product_name' => $product_name,
									  'unit_quantity' => $unit_quantity,
									  'unit_price' => $unit_price,
									  'quantity_to_purchase' => $quantity_to_purchase,
									  'line_totle' => $unit_price * $quantity_to_purchase);

					array_push($_SESSION['cart'], $item_array);
					break;
				case 'Clear':
					session_start();
					session_unset(); 
					session_destroy();							
					break;
				default:
					break;
			}

			if(is_null($_SESSION['cart'])) {
				echo "<p>No item in the cart</p>";
			}

		?>	

		<form name="cart" action="purchase_form.html" target='top_right'>
			<?php
	            print "<table>";
	            print "<tr>\n<th>Product Name</th><th>Unit Quantity</th><th>Unit Price</th><th>Quantity</th><th>Line Total</th></tr>";
		 		$totalPrice = 0;
			 	if(is_array($_SESSION['cart'])) {		 		
					foreach ($_SESSION['cart'] as $item) {
						print "<tr>\n";
						foreach ($item as $key => $value) {
							if ($key != 'product_id')
					        	print "<td class='productForm'>".$value."</td>";
					        if ($key == 'line_totle')				                
					            $totalPrice += $value;       								 	
						}
					 	print "</tr>";
					}
					$totalPrice = number_format($totalPrice, 2, '.', ',');
					$_SESSION['totalPrice'] = $totalPrice;
		        }
		        print "<tr><td colspan='5' class='button'>Total Price for shopping: $ ".$totalPrice."</td></tr>";
		        print "<tr><td colspan='4' class='button'><input type='submit'  class='checkout' name='action' value='Checkout'></td>";
	            $reloadURL = $_SERVER['PHP_SELF'] . "?action=Clear";
		        print "<td class='button'><form action = 'cart.php' method='GET'> <input type='button'  class='leftButton' name='action' value = 'Clear' onclick=\"window.open('$reloadURL','_self');\"></input></form></td></tr>";	       
	            print "</table>";


				echo "\$_SERVER['DOCUMENT_ROOT'] is " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
				echo "\$_SERVER['SERVER_NAME'] is " . $_SERVER['SERVER_NAME'] . "<br>";
				echo "\$_SERVER['SCRIPT_FILENAME'] is " . $_SERVER['SCRIPT_FILENAME'] . "<br>";
				echo "\$_SERVER['PHP_SELF'] is " . $_SERVER['PHP_SELF'] . "<br>";
				echo "\$reloadURL is " . $reloadURL . "<br>";
		    ?>
		</form>
		</div>
	</div>

</body>
</html>