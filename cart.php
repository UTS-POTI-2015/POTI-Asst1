<?php
	session_start();

	function getItemIndex($product_id) {
		if (isset($_SESSION['cart']))
			$size = sizeof($_SESSION['cart']);
		if ($size > 0) {
			for ($i = 0; $i < $size; ++$i) {
				if ($_SESSION['cart'][$i]['product_id'] == $product_id)
					return $i;
			}
		}
		return -1;
	}
?>
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
					
					if(!isset($_SESSION['cart'])) {
						$_SESSION['cart']=array();
					}

					$index = getItemIndex($product_id);
					if ($index < 0) {
						$item_array=array('product_id' => $product_id,
										  'product_name' => $product_name,
										  'unit_quantity' => $unit_quantity,
										  'unit_price' => $unit_price,
										  'quantity_to_purchase' => $quantity_to_purchase,
										  'line_total' => $unit_price * $quantity_to_purchase);

						array_push($_SESSION['cart'], $item_array);
					}
					else {
						$_SESSION['cart'][$index]['quantity_to_purchase'] += $quantity_to_purchase;
						$_SESSION['cart'][$index]['line_total'] += $unit_price * $quantity_to_purchase;
					}
					break;
				case 'Clear':
					session_unset(); 
					session_destroy();							
					break;
				default:
					break;
			}

			if(!isset($_SESSION['cart'])) {
				echo "<p>No item in the cart</p>";
			}
		?>	

		<form name="cart" action="purchase_form.php" target='top_right' onsubmit='return !isCartEmpty();'>
			<?php
	            print "<table>";
	            print "<tr>\n<th>Product Name</th><th>Unit Quantity</th><th>Unit Price</th><th>Quantity</th><th>Line Total</th></tr>";
	            print "<input type='hidden' name='cart_size' value=".sizeof($_SESSION['cart']).">";
		 		$totalPrice = 0;
			 	if(is_array($_SESSION['cart'])) {							 		
					foreach ($_SESSION['cart'] as $item) {
						print "<tr>\n";
						foreach ($item as $key => $value) {
							if ($key != 'product_id' && $key != 'line_total')
					        	print "<td class='productForm'>".$value."</td>";
					        if ($key == 'line_total') {
					        	print "<td class='productForm'>$ ".number_format($value,2,'.',',')."</td>";                
					            $totalPrice += $value; 
					        }      								 	
						}
					 	print "</tr>";
					}
					$_SESSION['totalPrice'] = $totalPrice;
		        }
		        print "<tr><td colspan='5' class='button'>Total Price for shopping: $ ".number_format($totalPrice, 2, '.', ',')."</td></tr>";
		        print "<tr><td colspan='4' class='button'><input type='submit'  class='checkout' name='action' value='Checkout'></td>";
	            $reloadURL = $_SERVER['PHP_SELF'] . "?action=Clear";
		        print "<td class='button'><form action = 'cart.php' method='GET'> <input type='button'  class='leftButton' name='action' value = 'Clear' onclick=\"window.open('$reloadURL','_self');\"></input></form></td></tr>";	       
	            print "</table>";
		    ?>
		</form>
		</div>
	</div>

<script type="text/javascript">
function isCartEmpty(){
	var cart_size = document.cart.cart_size.value;
	if (parseFloat(cart_size) === 0) {
	    alert("PLEASE ADD SOME ITEM IN THE CART!\n");
	    return true;
	};
	return false;
}
</script>
</body>
</html>