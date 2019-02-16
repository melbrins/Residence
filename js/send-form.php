<?php
    //we need to get our variables first  
  
    $email_to =   "admin@drwarehouse.co.uk";
    $name     =   $_POST['name'];  
    $email    =   $_POST['email'];  
    $subject  =   "D.R. Group Contact Form";  
    $message  =   $_POST['message'];  
  
    /*the $header variable is for the additional headers in the mail function, 
     we are asigning 2 values, first one is FROM and the second one is REPLY-TO. 
     That way when we want to reply the email gmail(or yahoo or hotmail...) will know 
     who are we replying to. */  
    $headers = "From: " . $email . "\n";
	$headers .= "Reply-To: " . $email . "\n"; 
  	
	$message = "Name: ". $name . "\r\nMessage:\n\n" . $message;
	
	ini_set("sendmail_from", $email);
	$sent = mail($email_to, $subject, $message, $headers, "-f" .$email);
	
    if($sent){  
        echo 'sent'; // we are sending this text to the ajax request telling it that the mail is sent..  
    }else{  
        echo 'failed';// ... or this one to tell it that it wasn't sent  
    }  
	
	?>