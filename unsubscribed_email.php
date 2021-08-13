<?php
$con = mysqli_connect("localhost","dev_invitation","%.+cuaiT$Dyg","dev_invitation");
if(isset($_GET['key']))
{
	$result=$con->query("INSERT INTO unsubscribed_emails set email='".base64_decode($_GET['key'])."'");
	echo '<h1>Email Unsubscribed successfully</h1>';
}
else
{
	echo "Invailid URL";
}

?>