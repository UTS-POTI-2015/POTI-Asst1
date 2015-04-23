<?php
session_start();

$subject = "Hello! Purchase order from Online Grocery Store"; 
$from = "From: noreply@onlinegrocerystore.com";

$name = $_POST['name']; // required
$address = $_POST['address']; // required
$suburb = $_POST['suburb']; // required
$state = $_POST['state']; // required
$country = $_POST['country']; // required
$to = $_POST['email']; 

//Build the email message
$email_message = "PURCHASE SUMMARY\n\n";
$email_message .= "Customer's details :\n";
$email_message .= "Name: ".$name."\n";
$email_message .= "Address: ".$address."\n";
$email_message .= "Suburb: ".$suburb."\n";
$email_message .= "State: ".$state."\n";
$email_message .= "Country: ".$country."\n\n";

$email_message .= "Order's details : \n";
$email_message .= str_pad('Product', 25);
$email_message .= str_pad('Unit Qty', 20);
$email_message .= str_pad('Ord. Qty & Price', 22);
$email_message .= str_pad('Line Total', 15)."\n";
$email_message .= "-------------------------------------------------------------------------------------"."\n";  
if(is_array($_SESSION['cart'])) {	
	foreach ($_SESSION['cart'] as $item) {
		$email_message .= str_pad($item['product_name'], 20);
		$email_message .= str_pad($item['unit_quantity'], 20);
		$email_message .= str_pad($item['quantity_to_purchase'].'@$'.number_format($item['unit_price'],2,'.',','), 20);
		$email_message .= str_pad('$'.number_format($item['line_total'],2,'.',','), 15)."\n"; 
	}
}

$email_message .= "\nAmount Payable: $".number_format($_SESSION['totalPrice'],2,'.',',')."\n";
date_default_timezone_set('Australia/Sydney');
$email_message .= "Order Date: ".date('h:i A, D, d-M-Y',time())."\n\n";

$email_message .= "Thank you for shopping at the Online Grocery Store.\n";
$email_message .= "Please make your payment to process the order further.";

//Send the email
$emailSent = mail($to, $subject, $email_message, $from);
$reloadURL =  "products.html";
$jsCmdonSent = "alert('Email has been sent successfully.');"."window.open('products.html','_self');".
				"window.open('menu.html','left');". "window.open('cart.html','bottom_right');";
$jsCmdonFail = "alert('Email has not been sent yet! Please refill the form.');"."window.open('/purchase_form.html','_self');";

if ($emailSent) {
	echo "<body bgcolor='#FDFFDF' onload=\"".$jsCmdonSent."\"></body>";
	session_unset(); 
	session_destroy();	
}
else {
	echo "<body onload=\"".$jsCmdonFail."\"></body>";	
}
?>
