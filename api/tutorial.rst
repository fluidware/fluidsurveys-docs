Tutorial
========
This tutorial will attempt to show you step by step how to integrate the FluidSurveys API into your application or website.

Introduction
````````````

In this tutorial we will be building a very simple web app to manage our surveys.  It should be able to:

* view a list of your surveys
* view responses to a survey
* take you to the survey to fill out
* create an invite to a survey
* add contacts to the invitation and send it

The app will be hosted on our own domain.  Because of security concerns and limitations in the browser we cannot easily query the FluidSurveys API from our web app.  Instead, we will create a proxy on our own domain that our web app will talk to.  This proxy will relay all requests to and from the API to our web app.  We will be writing in PHP but you can choose whichever language you are most comfortable with.

Before You Start
````````````````

You should be comfortable with the following before you being:

* having your own hosting solution (that can run PHP or your language of choice)
* knowledge of HTML5/CSS
* strong knowledge of Javascript and jQuery
* A FluidSurveys account and API key

It would be nice if we could use our web app while we are mobile so we will also be using jQueryMobile so make sure you keep the `jQuery Mobile Docs <http://jquerymobile.com/demos/1.0.1/>`_ handy for reference too.

Building a Proxy
````````````````

For the basics - our proxy needs to be able to do two things.  `GET` and `POST`.  We will create two functions using cURL to accomplish our task.

.. code-block:: php

	<?php
	$api_key = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$password = 'password';
	$url = 'https://app.fluidsurveys.com/api/v2';

	function POST($url,$data='',$form=false){
		global $api_key, $password;
		if($form){
			$type = 'Content-Type: application/x-www-form-urlencoded';
		}else{	
			//encode as json
			$data = json_encode($data);
			$data =  html_entity_decode($data);
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
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			$type,'Content-Length: '.strlen($data)));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 
			(compatible; MSIE 5.01; Windows NT 5.0)"); 
		curl_setopt($curl, CURLOPT_URL, $url); 

		$data = curl_exec($curl); 
		curl_close($curl); 
		return $data;
	}



This function takes a *url* and uses cURL to post *data* to it.  Most of it is just setting up the cURL options.  See the `php docs <http://php.net/manual/en/book.curl.php>`_ for more info.  It simply returns the unmodified response back to our app.

Simarily for GET:

.. code-block:: php

	<?php
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
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;
		 	MSIE 5.01; Windows NT 5.0)"); 
		curl_setopt($curl, CURLOPT_URL, $url); 
		$data = curl_exec($curl);
		curl_close($curl); 
		return $data;//json_decode($data,true);
	}

Now we just need some code to call these functions:

.. code-block:: php

	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		echo POST($_GET['uri'],$HTTP_RAW_POST_DATA);
		
	}elseif ($_SERVER['REQUEST_METHOD'] == 'GET'){
		echo GET($_GET['uri']);
	}else{
		echo '{"success":false}';
	}

If the proxy receives a POST, it passes the POST on to the API with the uri from the url, and similarly with GET requests.

Calling the Proxy
`````````````````

Now that we have a proxy to forward our requests to the API, we need something to create those requests.  This is all going to happen from within your applicaiton, in this case our website.  We'll use jQuery to create function that sends our request to the proxy.

.. code-block:: javascript

	proxy = 'http://www.yourdomain.com/proxy/proxy.php?uri=';
	
	function callAPI(type,uri,data,callback){
		var j = $.ajax({
			beforeSend: function(xhr){
				xhr.setRequestHeader('Content-Type', 'application/json');	
			},
			url: proxy+uri,
			type: type,
			processData:false,
			data: data,
			success: function(data){
				callback(JSON.parse(data));
			}
		});		
	}

Our function, aptly named callAPI accepts four parameters.  The type of request it's going to make (GET or POST), the uri that it is requesting, any data it is sending (blank string for GET requests) and a callback function to execute when it receives a response.  Since we are expecting all our responses to be JSON we parse the response into an object before passing it to the callback function.

Creating our Web App
````````````````````
For the purposes of this tutorial we are going to use plain HTML5.  Ideally you would enhance this with a framework of your own - as we have done in the demo using jQuery mobile.  You can check out the source of the enhanced and unenhanced versions at <github>

.. code-block:: html

	<!DOCTYPE html> 
	<html> 
		<head> 
		<title>FluidSurveys</title> 
		<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
		<script type="text/javascript" src="functions.js"></script>
		<script type="text/javascript" src="script.js"></script>

	</head>
	<body>
		<h1>My Surveys</h1>
		<div id="content">		
			<ul></ul>
			<a>New Survey</a>
		</div>
	</body>	
	</html>

We have two external scripts one for all our functions and one to drive the app.  Again, for the purpose of the tutorial we are not including any CSS - just the bare minimum.

In *script.js* we will make out first API call and get a list of our surveys.

.. code-block:: javascript

	SURVEYS = {};
	RESPONSES = [];
	base = 'https://app.fluidsurveys.com/api/v2';

	$(document).ready(function(){

		callAPI('GET',base+'/surveys/',false,function(data){
			var s = '';

			 $.each(data.surveys.reverse(),function(){
			 	s = s + '<li><a href="'+this.id+'">'+this.name+'</a></li>';
			 	SURVEYS['s'+this.id] = {title: this.name,
			 							creator: this.creator,
			 							created_at: this.created_at,
			 							responses: this.responses,
			 							deploy: this.deploy_uri,
			 							id: this.id
			 							};
			});		
			$('#content ul').delegate('a','click',function(){
						showSurvey(this.hash);
					});
			$('#content ul').append(s);
		});
	}); //end of document ready.

Our first call to the API gets a list of all our surveys.  We loop through the surveys we get back (stored in *data.surveys*) and save them in a list *SURVEYS* for later use.  We then populate the HTML list with the name of each survey.  We also delegate each link in the list to the showSurvey function.

Show Survey
```````````
We use the id of the survey as the *href* attibute in our list of surveys.  When the user clicks a link we know which survey to load.

.. code-block:: javascript

	function showSurvey( url ){
		var surveyID = url.substring(1),
			survey = SURVEYS[ 's'+surveyID ];
	
		if ( survey ) {
			markup = "<h3>Created by "+survey.creator+" on "+survey.created_at+".</h3><a href='' id=\"responses\">View "
				+survey.responses+" Responses</a><br /><a href=\""+survey.deploy+"\">Take the Survey</a>";
				
			callAPI('GET',base+'/surveys/'+survey.id+'/responses/',function(data){
				//add each of the responses to the responses list.
				RESPONSES = [];
				$.each(data.responses,function(i,response){
					re = [];
					$.each(response,function(key,value){
						if(key.lastIndexOf('_', 0) === 0){
							//this is a property of the response, ignore for now.
						}else{
							re.push({id:key,
									'value':value
									});
						}						
					});
					RESPONSES.push(re);
				});
			});//end callAPI
		
			$('h1').html(survey.title);
			$('#content').html(markup).delegate('#responses','click',function(){
						showResponses();
			}
	
		}
	}
	
*showSurvey* takes the survey id from the hash and populates the screen with the survey info.  It also calls the API and fetches the responses to this survey.  This is so that when the user clicks view responses they are preloaded and there is no noticeable delay to the user.  This is delegated to the showResponses function when the user clicks on the responses link.

Showing Responses
``````````````
Similar to showing a survey, *showResponses* takes the data we stored from our API call and displays it on the screen.

.. code-block:: javascript

	function showResponses()
	{
		if ( RESPONSES ) {
			var markup = "",
				numItems = RESPONSES.length;
		
			// Generate a list item for each item in the survey
			// and add it to our markup.
			for ( var i = 0; i < numItems; i++ ) {
			 	markup += "<ul>";
			 	var questions = RESPONSES[i].length;
			 	for (var j = 0; j < questions; j++){
			 		markup += "<li>" + RESPONSES[i][j].id + " : "+RESPONSES[i][j].value+"</li>";
			 	}
			 	markup += "</ul>"
			 }
		 
			 markup += "<a href=\"./\">Home</a>";
			$( "h1" ).html( 'Responses' );
			$("#content").html(markup);
		}
	}
	
