<?php
session_start();

$subject = "Purchase summary from Online Grocery Store"; 
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: noreply@onlinegrocerystore.com";

$name = $_POST['name']; // required
$address = $_POST['address']; // required
$suburb = $_POST['suburb']; // required
$state = $_POST['state']; // required
$country = $_POST['country']; // required
$to = $_POST['email']; 

$email_message = "<html><body>";
$email_message .= "<h2>PURCHASE SUMMARY</h2>";
$email_message .= "<h3>Customer's details :</h3>";
$email_message .= "<ul><li>Name: ".$name."</li>";
$email_message .= "<li>Address: ".$address."</li>";
$email_message .= "<li>Suburb: ".$suburb."</li>";
$email_message .= "<li>State: ".$state."</li>";
$email_message .= "<li>Country: ".$country."</li>";
$email_message .= "<li>Email: ".$to."</li></ul>";

$email_message .= "<h3>Order's details : </h3>";
$email_message .= "<table>";
$email_message .= "<tr><th>Product Name</th><th>Unit Quantity</th><th>Unit Price</th><th>Quantity</th><th>Line Total</th></tr>";

if(is_array($_SESSION['cart'])) {							 		
	foreach ($_SESSION['cart'] as $item) {
		$email_message .= "<tr>";
		foreach ($item as $key => $value) {
			if ($key != 'product_id' && $key != 'unit_price' && $key != 'line_total')
	        	$email_message .= "<td>".$value."</td>";
	        if ($key == 'unit_price' || $key == 'line_total') {
	        	$email_message .=  "<td>$ ".number_format($value,2,'.',',')."</td>";                
	        }      								 	
		}
	 	print "</tr>";
		}
	$email_message .= "<tr><td colspan='5' align='right'>Total Price : $ ".number_format($_SESSION['totalPrice'], 2, '.', ',')."</td></tr>";
}

$email_message .= "</table><br>";
$email_message .="<p>Thank you for shopping at the Online Grocery Store.</p>";
$email_message .="<p>Please make your payment to process the order further.</p>";

date_default_timezone_set('Australia/Sydney');
$email_message .="<p>"."Order Time: ".date('h:i A, D, d-M-Y',time())."</p>";
$email_message .= "<br></body></html>";

//Send the email
$emailSent = mail($to, $subject, $email_message, $headers);
$reloadURL =  "products.html";

$jsCmdOnSent = "alert('Email has been sent successfully.');";
$jsCmdOnSent .= "window.open('menu.html','left');";
$jsCmdOnSent .= "window.open('products.html','_self');";
$jsCmdOnSent .= "window.open('cart.php','bottom_right');";

$jsCmdOnFail = "alert('Email has not been sent yet! Please refill the form.');";
$jsCmdOnFail .= "window.open('/purchase_form.php','_self');";

if ($emailSent) {
	echo "<body bgcolor='#FDFFDF' onload=\"".$jsCmdOnSent."\"></body>";
	session_unset(); 
	session_destroy();	
}
else {
	echo "<body bgcolor='#FDFFDF' onload=\"".$jsCmdOnFail."\"></body>";	
}
?>
