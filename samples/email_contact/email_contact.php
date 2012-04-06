<?php

//constants - you can find your API key on the settings page
$api_key = 'ABCDDEFGHIJKLMNOPQRSTUVWXYZ';
$password = 'password';
$url = 'https://app.fluidsurveys.com/api/v2';

//some helper methods to handle our HTTP requests
function POST($url,$data='',$form=false){
	global $api_key, $password;
	
	if($form){
		//we will be sending json data most often, but can set the $form flag to post regular form data.
		$type = 'Content-Type: application/x-www-form-urlencoded';
	}else{	
		$data = json_encode($data);
		$data =  html_entity_decode($data);	//small hack because our version of PHP doesn't seem to want to escape characters in json_encode
		$type = 'Content-Type: application/json';
	}
	
	//set a bunch of curl options
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC) ; 
	curl_setopt($curl, CURLOPT_USERPWD, $api_key.':'.$password); 
	curl_setopt($curl, CURLOPT_SSLVERSION,3); 
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); 
	curl_setopt($curl, CURLOPT_HEADER, false); 
	curl_setopt($curl, CURLOPT_POST, true); 
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 
	curl_setopt($curl, CURLOPT_HTTPHEADER, array($type,'Content-Length: '.strlen($data)));curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)"); 
	curl_setopt($curl, CURLOPT_URL, $url); 
	
	$data = curl_exec($curl); 
	curl_close($curl); 
	return json_decode($data,true);
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
	return json_decode($data,true);
}

//Get a list of surveys - we are just choosing the first one for our example
$r = GET("$url/surveys/");
$survey_id = $r['surveys'][0]['id'];
echo 'Found survey '.$survey_id;

//Create a contact
$contact = array('name'=>'John Doe','email'=>'john_doe_1@example.com');
$r = POST("$url/contacts/",$contact);
$contact_id = $r['contact']['id'];
echo "<br />Created contact $contact_id";

//Create an email - note we have to use HTML entities because our version of PHP's json_encode wouldn't escape them, your results may vary.
//Also the "recipients=All" field is no longer required, but was required in earlier versions of the API.  It is included here for legacy purposes.
$email = array('subject'=>'Hello World','sender'=>'Bob &lt;bob@example.com&gt;','message'=>'Hello [Full Name]<br /><br />, Full out our survey for a change to win!<br /><br />[Invite Link]');
$r = POST("$url/emails/?survey=$survey_id",$email);
$send_uri = $r['send_uri'];
$email_id = $r['id'];
$recipients_uri = $r['recipients_uri'];

echo '<br />Created email:'.$email_id;

//Add Contact to Email - note we are *not* sending this as JSON data!
$r = POST($recipients_uri, "contacts=$contact_id", true);
echo '<br />Added contact:'.$r['added'];

//Send email - will be scheduled to send out in a few miuntes.
$r = POST($send_uri, '', true);
echo '<br />Email is '.$r['status']. ' to send to '.$r['num_recipients'].' recipients.';


