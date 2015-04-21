<?php
session_start();

$subject = "Hello! This is online shopping"; 
$from = "From: noreply@onlinegrocerystore.com";

$name = $_POST['name']; // required
$address = $_POST['address']; // required
$suburb = $_POST['suburb']; // required
$state = $_POST['state']; // required
$country = $_POST['country']; // required
$to = $_POST['email']; 

$email_message = "Form details below.\n\n";
$email_message .= "Name: ".$name."\n";
$email_message .= "Address: ".$address."\n";
$email_message .= "Suburb: ".$suburb."\n";
$email_message .= "State: ".$state."\n";
$email_message .= "Country: ".$country."\n";
$email_message .= "Amount Payable: ".$_SESSION['totalPrice']."\n";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$email_message = wordwrap($email_message, 70, "\r\n");

// Send
$emailSent = mail($to, $subject, $email_message, $from);

if (!$emailSent)
	echo "<script type='text/javascript'>"."alert('Email has not been sent yet!);"."</script>";
else
	echo "<script type='text/javascript'>"."alert('Email has been sent!);"."</script>";

session_unset(); 
session_destroy();	
?>
