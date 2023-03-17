<?php

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <lalpower77@gmail.com>' . "\r\n";
$headers .= 'Cc: maharjanoptex@gmail.com' . "\r\n";

if(mail("subashthulung13@gmail.com", "Hi from localhost", "<b>Hi subash</b> you are getting this email from localhost. Pls dont reply.", $headers)){
    echo "Email Send";
}
else{
    echo "Unable to send the email";
}
?>