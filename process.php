<?php
    $to = "lrosario@archercom.com";
    $from = $_REQUEST['email'];
    $name = $_REQUEST['name'];
    $headers = "From: $from";
    $subject = "New Contact Form submission";
    $fields = array();
    $fields{"name"} = "name";
    $fields{"email"} = "email";
    $fields{"phone"} = "phone";
    $fields{"message"} = "message";
    $body = "Here is what was sent:\n\n"; foreach($fields as $a => $b){   $body .= sprintf("%20s: %s\n",$b,$_REQUEST[$a]); }
    $send = mail($to, $subject, $body, $headers);
?>
