<?php
 $okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';
 
 // If something goes wrong, we will display this message.
 $errorMessage = 'There was an error while submitting the form. Please try again later.';
 
 error_reporting(E_ALL & ~E_NOTICE);

try{
 $_from = $_POST["from"];
 $_name = $_POST["name"];
 $_message = $_POST["message"];
 
 $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'Content-Transfer-Encoding: 8bit',
        'From: ' . $_from,
        'Reply-To: ' . $_from,
        'Return-Path: ' . $_from,
    );
 
 $fullMessage = ['From : '.$_name.'  ( '.$_from.' )','','Message :',$_message];
 
 mail('contact@cprinsloocounselling.ch','New Contact Form Email from "'.$_name.'"',
 implode("\n",$fullMessage), implode("\n", $headers));
 
  $responseArray = array('type' => 'success', 'message' => $okMessage);
 
}catch(\Exception $e){
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}else{
    echo $responseArray['message'];
}
?>

