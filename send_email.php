<?php 

function died($error) {
    // your error code can go here
    echo "We are very sorry, but there were error(s) found with the form you submitted. ";
    echo "These errors appear below.<br/><br/>";
    echo $error."<br/><br/>";
    echo "Please go back and fix these errors.<br/><br/>";
    die();
}
 
    // validation expected data exists
    if(!isset($_POST['name']) ||  
       !isset($_POST['address']) ||
       !isset($_POST['suburb']) ||
       !isset($_POST['state']) ||
       !isset($_POST['country']) ||
       !isset($_POST['email'])) {
         died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }


  if(isset($_POST['email'])) {
    $to = $_POST['email'];     
    $subject = "Hello! This is online shopping"; 
    $from = "From: noreply@onlinegrocerystore.com";
  }
    $name = $_POST['name']; // required
    $address = $_POST['address']; // required
    $suburb = $_POST['suburb']; // required
    $state = $_POST['state']; // required
    $country = $_POST['country']; // required
    $error_message = "";
  //   $email_exp = '/^[A-Za-z0-9\._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  // if(!preg_match($email_exp,$email_from)) {
  //   $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  // }
  //   $string_exp = "/^[A-Za-z .'-]+$/";
  // if(!preg_match($string_exp,$name)) 
  //   $error_message .= 'The Name you entered does not appear to be valid.<br/>';
  // if(!preg_match($string_exp,$address)) 
  //   $error_message .= 'The address you entered does not appear to be valid.<br/>';
  // if(!preg_match($string_exp,$suburb)) 
  //   $error_message .= 'The suburb you entered does not appear to be valid.<br/>';
  // if(!preg_match($string_exp,$state)) 
  //   $error_message .= 'The state you entered does not appear to be valid.<br/>';
  // if(!preg_match($string_exp,$country)) 
  //   $error_message .= 'The country you entered does not appear to be valid.<br/>';
  // if(strlen($error_message) > 0) 
  //   died($error_message);
     
  function clean_string($string) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    return str_replace($bad,"",$string)
  };

  $email_message = "Form details below.\n\n";
  $email_message .= "Name: ".clean_string($name)."\n";
  $email_message .= "Address: ".clean_string($address)."\n";
  $email_message .= "Suburb: ".clean_string($suburb)."\n";
  $email_message .= "State: ".clean_string($state)."\n";
  $email_message .= "Country: ".clean_string($country)."\n";
  
  //now lets send the email. 
  $emailSent = mail($to, $subject, $email_message, $from); 

  if (!$emailSent)
    print "email failed.";
  else
    print "email sent."; 
?>