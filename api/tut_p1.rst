.. _tutorial-one:

Tutorial Part I: 'GET' the Basics
-------------------------------

In this part of the tutorial we will show you how to set up a proxy between the FluidSurveys API and your website and how to GET surveys and responses.

Building a Proxy
````````````````

For Part I our proxy only needs to be able to `GET`. In Part II we will need to add the ability to `POST`.

This function takes a *url* and uses cURL to GET the result.  Most of it is just setting up the cURL options.  See the `php docs <http://php.net/manual/en/book.curl.php>`_ for more info.  It simply returns the unmodified response back to our app.  We will put this in a file called *proxy.php*.

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
		return $data;
	}

Now we just need some code to call the function:

.. code-block:: php

	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		echo GET($_GET['uri']);
	}

If the proxy receives a `GET` request it sends calls the *GET* function to forward the request to the API.

Creating our Web App
````````````````````
For the first parts of this tutorial we are going to use plain HTML and barely any CSS.  Eventually, in a later part of the tutorial we will enhance this with a mobile framework.  We also have two javascript files, *functions.js* to hold all our functions and *script.js*, as well as the latest version of jQuery.

.. code-block:: html

	<!DOCTYPE html> 
	<html> 
		<head>
		<meta charset="utf-8" />
		<title>FluidSurveys</title> 
		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="functions.js"></script>
		<script type="text/javascript" src="script.js"></script>
		<link rel="stylesheet" type="text/css" href="basic.css" />

	</head>
	<body>
		<h1>My Surveys</h1>
		<div id="content">
			<ul></ul>
		</div>
	</body>	
	</html>

Calling the Proxy
`````````````````

Now that we have a proxy to forward our requests to the API, we need something to create those requests.  This is all going to happen from within your application, in this case our website.  We will write a function around jQuery's ajax method to send our request to the proxy and store it in *functions.js*.

.. code-block:: javascript

	function callAPI(type,uri,callback){
		var proxy = 'http://www.yourdomain.com/proxy.php?uri=';
		var j = $.ajax({
		url: proxy+uri,
			type: type,
			success: function(data){
				callback(JSON.parse(data));
			}
		});		
	}

Our function, aptly named callAPI accepts three parameters.  The type of request it's going to make ('GET'), the uri that it is requesting, and a callback function to execute when it receives a response.  Since we are expecting all our responses to be JSON we parse the response into an object before passing it to the callback function.

In *script.js* we will make out first API call when the document is ready and get a list of our surveys.

.. code-block:: javascript

	$(document).ready(function(){	
		callAPI('GET', base+'/surveys/', function(data){
			var markup = '';

			 $.each(data.surveys.reverse(),function(){
			 	markup += '<li><a href="#'+this.id+'">'+this.name+'</a></li>';
			 	SURVEYS['s_'+this.id] = 
					{	title: this.name,
			 			creator: this.creator,
			 			created_at: this.created_at,
			 			responses: this.responses,
			 			deploy: this.deploy_uri,
			 			id: this.id
			 		};
			});		

			$('#content ul').append(markup);

			$('#content ul').on('click', 'a', function(){
				//delegate click event to survey links
				showSurvey(this.hash);
			});	
		});
	}); //end of document ready.

We loop through the surveys we get back (found in *data.surveys*) and save them in a object *SURVEYS* for later use.  We then populate the HTML with the name of each survey.  We also delegate the survey links to the showSurvey function.

Show Survey
```````````
We use the id of the survey as the *href* attribute to use to access from our *SURVEY* container.  When the user clicks a link we will know which survey to load by examining the url hash.

.. code-block:: javascript

	function showSurvey( url ){

		var surveyID = url.substring(1),

			survey = SURVEYS[ 's_'+surveyID ];

		if ( survey ) {

			markup = "<h3>Created by "+survey.creator+" on "+survey.created_at+
				".</h3><a href=\"#\" id=\"responses\">View "+survey.responses+
				" Responses<a><br /><br /><a href=\""+survey.deploy+"\">
				Take the Survey</a><br /><br /><a href='./'>
				&larr;&nbsp;Surveys</a>";

			callAPI('GET',base+'/surveys/'+survey.id+'/responses/', function(data)
				{
				//add each of the responses to the responses list.
				RESPONSES = [];
				$.each(data.responses,function(i,response){
					re = [];
					$.each(response,function(key,value){
						if(key.lastIndexOf('_', 0) === 0){
							//this is a property of the response, 
							//ignore for now.
						}else{
							//console.log(key,value);
							re.push({id:key,
									'value':value
									});
						}						
					});
					RESPONSES.push(re);
				});
			});//end callAPI

			$('h1').html(survey.title);
			$('#content').html(markup);
			$('#responses').on('click',function(){
				showResponses();
			});
		}
	}
	
*showSurvey* takes the survey id from the url hash and populates the screen with the survey info.  It also calls the API and fetches the responses to this survey.  Storing them in the *RESPONSES* array. This is so that when the user clicks view responses they are preloaded and the user won't have to wait for them to load.  The *showResponses* function is also bound to the show responses.

Showing Responses
`````````````````
Similar to showing a survey, *showResponses* takes the data we stored from our previous API call and displays it on the screen.

.. code-block:: javascript

	function showResponses(){
		//displays the currently stored RESPONSES

		if ( RESPONSES ) {
			var markup = "",
				numItems = RESPONSES.length;

			// Generate a list for each response.
			for ( var i = 0; i < numItems; i++ ) {
			 	markup += "<ul>";
			 	var questions = RESPONSES[i].length;

			 	//Generate a list item for each answer in the response.
			 	for (var j = 0; j < questions; j++){
			 		markup += "<li>" + RESPONSES[i][j].id + " : "+
					RESPONSES[i][j].value+"</li>";
			 	}
			 	markup += "</ul>"
			 }

			 markup += "<a href=\"./\">&larr;&nbsp;Surveys</a>";
			$( "h1" ).html( 'Responses' );
			$("#content").html(markup);
		}
	}

*showResponses* displays each response group in it's own list.  Unfortunately at the time of this writing the question labels were not included with the responses so we have just labeled them with their ID's here.

Summary
```````

We have shown you how to set up a simple proxy that you can use to forward GET requests to the FluidSurveys API and back to your website.  Check back soon for Part II were we get interactive and start ``POST``-ing some data to the API

In the meantime be sure to checkout the `documentation <http://docs.fluidsurveys.com>`_ for more details and examples.

View the source on `Github <https://github.com/chideit/fluidsurveys-docs/tree/master/samples/tutorial/part1>`_

In :ref:`tutorial-two` - we get our contact lists, create an email and send it to a contact list!