<?php

// set HTTP header
$headers = array(
    'Content-Type: application/json',
);

if (isset($_GET['appId'])) {
    $appId = $_GET['appId'];
}
if (isset($_GET['securityToken'])) {
    $securityToken = $_GET['securityToken'];
}


$fields = array(
	'appId' => $appId,
	'securityToken' => $securityToken,
);

$url = 'http://myqexternal.myqdevice.com/api/UserDeviceDetails?' . http_build_query($fields);

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