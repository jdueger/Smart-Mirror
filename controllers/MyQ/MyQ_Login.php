<?php

//error_reporting(E_ERROR | E_PARSE);
// set HTTP header
$headers = array(
    'Content-Type: application/json',
);

if (isset($_GET['appId'])) {
    $appId = $_GET['appId'];
}
if (isset($_GET['username'])) {
    $username = $_GET['username'];
}
if (isset($_GET['password'])) {
    $password = $_GET['password'];
}
if (isset($_GET['culture'])) {
    $culture = $_GET['culture'];
}

$fields = array(
	'appId' => $appId,
	'username' => $username,
	'password' => $password,
	'culture' => $culture
);

$url = 'http://myqexternal.myqdevice.com/Membership/ValidateUserWithCulture?' . http_build_query($fields);

//print_r($url);

/*
// Open connection
$ch = curl_init();

// Set the url, number of GET vars, GET data
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Execute request
$result = curl_exec($ch);

// Close connection
curl_close($ch);

// get the result and parse to JSON
$result_arr = json_decode($result, true);

*/

$json = file_get_contents($url);

$result_arr = json_decode($json,true);

echo($json);

/*
$i=0;

echo "{";

foreach ($result_arr as $value) {
  
  echo $i;
  echo ": ";
  echo $value;
  echo ",\r\n";
  $i = $i + 1;
  
}
echo "}";
*/

/*
 *  output:
 *  Array
 *  (
 *      [statusCode] => "OK",
 *      [statusMessage] => "",
 *      [ipAddress] => "123.13.123.12",
 *      [countryCode] => "MY",
 *      [countryName] => "MALAYSIA",
 *  )
 */