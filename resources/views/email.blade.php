<?php



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html> <head> <title>Promotion Email</title> </head> <body> <p>This email contains HTML Tags!</p> <table> <tr><td>".$emailContent."</td></tr> <tr><td>This message was sent to my [Facebook friends | LinkedIn contacts | Google contacts | Yahoo contacts | Email contracts]<br> If you don't want to receive these emails in the future, please <a href='http://dev.balanceedutainment.com/unsubscribed_email.php?key=".base64_encode($emailAddress)."'>press here</a>.</td></tr></table> </body> </html>
