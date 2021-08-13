<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
?>
<?php
$accesstoken = '';
$max_results = 500;
$client_id = 'client_id';
$client_secret = 'secret_id';
$redirect_uri = 'url redirect';
$simple_api_key = 'api key';
$auth_code = $_GET["code"];

function curl_file_get_contents($url) {
$curl = curl_init();
$userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)';

// This can also be set when initializing a session with curl_init().
curl_setopt($curl, CURLOPT_URL, $url); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE); 
curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE); 
curl_setopt($curl, CURLOPT_TIMEOUT, 10);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
 curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

$contents = curl_exec($curl);
curl_close($curl);
return $contents;
}

$fields = array(
'code' => urlencode($auth_code),
'client_id' => urlencode($client_id),
'client_secret' => urlencode($client_secret),
'redirect_uri' => urlencode($redirect_uri),
'grant_type' => urlencode('authorization_code')
);
$post = '';
foreach ($fields as $key => $value) {
$post .= $key . '=' . $value . '&';
}
$post = rtrim($post, '&');

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
curl_setopt($curl, CURLOPT_POST, 5);
curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
$result = curl_exec($curl);

curl_close($curl);

$response = json_decode($result);


if (isset($response->access_token)) {
$accesstoken = $response->access_token;
$_SESSION['access_token'] = $response->access_token;
}
if (isset($_GET['code'])) {
$accesstoken = $_SESSION['access_token'];
}

if (isset($_REQUEST['logout'])) {

unset($_SESSION['access_token']);

}

$url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results=' . $max_results . '&oauth_token=' . $accesstoken;
$xmlresponse = curl_file_get_contents($url);

if ((strlen(stristr($xmlresponse, 'Authorization required')) > 0) && (strlen(stristr($xmlresponse, 'Error ')) > 0)) {
echo "<h2>OOPS !! Something went wrong. Please try reloading the page.</h2>";
exit();
}

$xml = new SimpleXMLElement($xmlresponse);
$xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005/Atom');

$result = $xml->xpath('//gd:email');

foreach ($result as $title) {
$arr[] = $title->attributes()->address;
echo $title->attributes()->displayName;
}
//print_r($arr);
foreach ($arr as $key) {
//echo $key."<br>";
}

$response_array = json_decode(json_encode($arr), true);

// echo "<pre>";
// print_r($response_array);
//echo "</pre>";

$email_list = '';
foreach ($response_array as $value3) {

$email_list = ($value3[0] . ",") . $email_list;
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Export Google Contacts Using PHP</title>

</head>
<body>

<div id="main" >

<div class="col-sm-6 col-md-4 col-lg-2">
<div  class="col-sm-6 col-md-4 col-lg-2">
<header id="sign_in">
<h2> <form action='csvdownload.php' method='post'>
<input type='text' value= '{{{PHP3}}}' name='email' style='display: none'>
<input type='submit' width='100' name="importexcel" value='submit'>
</form>
Export Gmail Contacts<a href='https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://tutorialswebsite.com/index.php' >Logout</a></h2>
</header>
<hr>
<div class="col-sm-6 col-md-4 col-lg-2">
<div class="col-sm-6 col-md-4 col-lg-2">
<div class="col-sm-6 col-md-4 col-lg-2">
<table cellspacing='0'>
<thead>
<td id="name">S.No</td>
<td>Email Addresses</td>
</thead>
<?php
$count = 0;
foreach ($result as $title) {
?>
<tr>
<td><?php echo $count;
$count++ ?></td>
<td><?php echo $title->attributes()->address; ?></td>
</tr>
<?php
}
?></table>

</div>

</div>
</div>
</div>
</div>
</div>

</body></html>