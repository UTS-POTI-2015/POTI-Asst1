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
			$form_button = $_REQUEST['form_button'];
			switch ($form_button) {
				case 'Add':
					print "In the switch case ADD"." <br>";
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
					print "In the switch case CLEAR to delete session"." <br>";
					session_start();
					session_unset(); 
					session_destroy();							
					break;
				case 'Checkout':
					print "In the switch case CHECKOUT"." <br>";
					//launch confirmation page to send an email
					break;
				default:
					print "Non-defined button pressed!";
					break;
			}

			
			// echo "product_id is " . $product_id . "<br>";
			// echo "product_name is " . $product_name . "<br>";
			// echo "unit_quantity is " . $unit_quantity . "<br>";
			// echo "unit_price is " . $unit_price . "<br>";
			// echo "quantity_to_purchase is " . $quantity_to_purchase . "<br>";


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
					$_SESSION['totalPrice'] = $totalPrice;
		        }
		        print "<tr><td colspan='5' class='button'>Total Price for shopping: $ ".$totalPrice."</td></tr>";
		        print "<tr><td colspan='4' class='button'><input type='submit' name = 'form_button' value='Checkout'></td>";
		        print "<td class='button'><form action = 'cart.php' method='GET'> <input type ='submit' name = 'form_button' value = 'Clear' ></input></form></td></tr>";
				//print "<td class='button'><input type='button' value='Clear' onclick='document.cart.reset();return false;''></tr>";	       
	            print "</table>";
		    ?>
			</form>
		</div>
	</div>

</body>
</html>