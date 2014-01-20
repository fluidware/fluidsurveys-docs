<?php

//replace these credentials with your own
//you can find your API key on the account settings page
$api_key = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$url = 'https://app.fluidsurveys.com/api/v2';
$password = 'PASSWORD';

function GET($url){
	global $api_key, $password;
	$curl = curl_init(); 
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
	curl_setopt($curl, CURLOPT_USERPWD, $api_key.':'.$password); 
	curl_setopt($curl, CURLOPT_SSLVERSION,3); 
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); 
	curl_setopt($curl, CURLOPT_HEADER, false); 
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)"); 
	curl_setopt($curl, CURLOPT_URL, $url); 
	$data = curl_exec($curl);
	curl_close($curl); 
	return $data;
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	echo GET($_GET['method']);
}
