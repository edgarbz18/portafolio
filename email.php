<?php
// $subject = 'You Got Message'; // Subject of your email
// $to = 'edgar-256@hotmail.com';  //Recipient's E-mail
$emailTo = $_REQUEST['email'];

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$msg = $_POST['message'];


$to = 'edgar-256@hotmail.com';

$subject = 'You Got Message';

$body = "Nombre: $name\n";
$body .= "Email: $email\n";
$body .= "Teléfono: $phone\n\n";
$body .= "Mensaje:\n$message";

$email_from = $name.'<'.$email.'>';

$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";

// $headers = "MIME-Version: 1.1";
// $headers .= "Content-type: text/html; charset=iso-8859-1";
// $headers .= "From: ".$name.'<'.$email.'>'."\r\n"; // Sender's E-mail
// $headers .= "Return-Path:"."From:" . $email;

// $message .= 'Name : ' . $name . "\n";
// $message .= 'Email : ' . $email . "\n";
// $message .= 'Phone : ' . $phone . "\n";
// $message .= 'Message : ' . $msg;

if (@mail($to, $subject, $body, $email_from, $headers))
{
	// Transfer the value 'sent' to ajax function for showing success message.
	echo 'sent';
}
else
{
	// Transfer the value 'failed' to ajax function for showing error message.
	echo 'failed';
}
?>