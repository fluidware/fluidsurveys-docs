<?php
$api_key = 'sqK4BqHwfDVd8qxkgCGSkTrQ4m44rf';
//$api_key = 'nkZrC56zT7xBbTzxkxX54WnMC53XX8';//dev machine
$password = 'g0cowboys';
$url = 'https://app.fluidsurveys.com/api/v2';
//$url = 'http://fluidsurveys.dev:8000/api/v2';

function POST($url,$data='',$form=false){
	global $api_key, $password;
	if($form){
		$type = 'Content-Type: application/x-www-form-urlencoded';
	}else{	
		//encode as json
		//$data = json_encode($data);
		//$data =  html_entity_decode($data);
		$type = 'Content-Type: application/json';
	}
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC) ; 
	curl_setopt($curl, CURLOPT_USERPWD, $api_key.':'.$password); 
	curl_setopt($curl, CURLOPT_SSLVERSION,3); 
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); 
	curl_setopt($curl, CURLOPT_HEADER, false); 
	curl_setopt($curl, CURLOPT_POST, true); 
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 
	curl_setopt($curl, CURLOPT_HTTPHEADER, array($type,'Content-Length: '.strlen($data)));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)"); 
	curl_setopt($curl, CURLOPT_URL, $url); 
	$input = $data;
	$data = curl_exec($curl);
	//echo curl_error($curl);
	//echo $type;
	//echo $url;
	//echo $input;
	//echo $data;
	$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	//echo $httpcode;
	//echo 'Result: '.$data;
	curl_close($curl); 
	return $data;
}

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
header('Access-Control-Allow-Origin: *');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$i = count($_POST);
	if ($i == 0){
			$form = false;
			$raw = file_get_contents('php://input');	
	}else{
		$form = true;
		$raw = '';
		foreach($_POST as $key => $value) {
			$raw = $raw.$key.'='.$value.'&';
		}
	}
	
	echo POST($_GET['method'], $raw, $form);
		
}elseif ($_SERVER['REQUEST_METHOD'] == 'GET'){
	echo GET($_GET['method']);
}else{
	echo 'Error: Request must be POST or GET';
}
