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

$email_message = "PURCHASE SUMMARY\n\n";
$email_message .= "Customer's details :\n";
$email_message .= "Name: ".$name."\n";
$email_message .= "Address: ".$address."\n";
$email_message .= "Suburb: ".$suburb."\n";
$email_message .= "State: ".$state."\n";
$email_message .= "Country: ".$country."\n\n";

$email_message .= "Order's details : \n";
if(is_array($_SESSION['cart'])) {	
	foreach ($_SESSION['cart'] as $item) {
		foreach ($item as $key => $value) {
			if ($key = 'product_name')
	        	$email_message .= str_pad($value.'-', 30);
	        if ($key = 'unit_quantity')
	        	$email_message .= str_pad($value.'\t', 20);
	        if ($key = 'unit_price')
	        	$email_message .= str_pad('$'.number_format($value,2).' * ', 10);
	        if ($key = 'quantity_to_purchase')
	        	$email_message .= str_pad($value.'\t', 5);
	        if ($key == 'line_totle')				                
	            $email_message .= str_pad('$'.number_format($value,2).'\n', 10);      								 	
		}
	}
}

$email_message .= "Amount Payable: $".number_format($_SESSION['totalPrice'],2)."\n";
date_default_timezone_set('Australia/Sydney');
$email_message .= "Order Date: ".date('h:i A, D, d-M-Y',time())."\n\n";

$email_message .= "Thank you for shopping at the Online Grocery Store.\n";
$email_message .= "Please make your payment to process the order further.";
// In case any of our lines are larger than 70 characters, we should use wordwrap()
//$email_message = wordwrap($email_message, 70, "\r\n");

// Send
$emailSent = mail($to, $subject, $email_message, $from);
//$reloadURL =  $_SERVER['SERVER_NAME'] . "/~jufeng/assignment1/products.html";
$reloadURL =  "products.html";
$jsCmdonSent = "alert('reloadURL is $reloadURL.  Email has been sent successfully.');"."window.open('products.html','_self');".
				"window.open('menu.html','left');". "window.open('cart.html','bottom_right');";
$jsCmdonFail = "alert('Email has not been sent yet! Please refill the form.');"."window.open('/purchase_form.html','_self');";

if ($emailSent) {
	echo "<body bgcolor='#FDFFDF' onload=\"".$jsCmdonSent."\"></body>";
	session_unset(); 
	session_destroy();	
	//header("Location: http://www-student.it.uts.edu.au/~jufeng/assignment1/index.html");
}
else {
	echo "<body onload=\"".$jsCmdonFail."\"></body>";	
}

?>
