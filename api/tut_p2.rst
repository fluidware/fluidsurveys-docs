.. _tutorial-two:

Tutorial Part II: `POST`-IT
-------------------------------

In part one of our tutorial we showed you how to `GET` data from the API.  This time we show you how to `POST` data *to* the API.

`POST`
``````

In part I our proxy only needed to handle `GET` requests.  Now we need to add a function in *proxy.php* to handle `POST`:

.. code-block:: php

	<?
	function POST($url,$data='',$form=false){
		global $api_key, $password;
		if($form){
			$type = 'Content-Type: application/x-www-form-urlencoded';
		}else{	
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
		curl_setopt($curl, CURLOPT_HTTPHEADER, array($type,'Content-Length: ' .
			strlen($data)));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;
			MSIE 5.01; Windows NT 5.0)"); 
		curl_setopt($curl, CURLOPT_URL, $url); 
	
		$data = curl_exec($curl);
		curl_close($curl); 
		return $data;
	}

We then need to modify the main body of of *proxy.php* file so that it handles GET and POST requests:

.. code-block:: php

	<?
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (count($_POST) == 0){
				//if $_POST is empty there is no form data
				$form = false;
				$raw = file_get_contents('php://input');	
		}else{
			//PHP doesn't let us access raw post data if it's part of a form, 
			//so we recreate the request body ourselves 
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

POSTing to the API
```````````````````
We need to make a small change to our JavaScript function that calls the API to tell it which data to ``POST``.

.. code-block:: javascript

	function callAPI(type,url,data,callback){
		//our AJAX function that calls our proxy

		var proxy = 'http://www.speg.com/chideit/proxy/proxy.php?method=';

		var j = $.ajax({
				beforeSend: function(xhr){
					if(typeof(data) === 'string' && data.lastIndexOf(
						'{', 0) ===0){
						xhr.setRequestHeader('Content-Type', 'application/json');}
					else {xhr.setRequestHeader('Content-Type', 
					'application/x-www-form-urlencoded');}	
				},
				url: proxy+url,
				type: type,
				data: data,
				success: function(data){
					//since the API always returns JSON - we will parse the data
					//right here and pass it to callback
					callback(JSON.parse(data));
				},
				error: function(event, jqXHR, ajaxSettings, thrownError){
					console.log(event, jqXHR, ajaxSettings, thrownError);
				}
			});		
	}
	
We've done a few things here.  First, added a *data* parameter which is what we're going to be POSTing.  Remember to go back and pass a null or empty string for our GET requests.  Or if you're feeling fancy look at through the function's `arguments` dynamically.  Second, we set the headers based on the type of data.  Lastly, we set the jQuery.ajax's data value to equal our own.

Getting Contacts
````````````````
In order to send an email we first need some contacts to send it to.  You can fetch your contact lists with a `GET` request:

	``callAPI('GET','/contact-lists/',false,loadContactLists);``
	
We will call this from the document ready function the same time we get our list of surveys:

.. code-block:: javascript

	$(document).ready(function(){
		callAPI('GET','/surveys/',false, function(data){
			//see part I of the tutorial
		});
		
		//now call request the contact-lists
		callAPI('GET','/contact-lists/',false,loadContacts);
	});

We get our lists of contacts on document ready and send the result the loadContacts function

.. code-block:: javascript

	function loadContactLists(data){
		//Recieves a list of contact lists and stores them in the global CONTACTLISTS.
		for(var i=0; i<data.total; i++){
			//add each list to CONTACTLISTS
			CONTACTLISTS.push({
				contacts: data.lists[i].contacts,
				contacts_uri: data.lists[i].contacts_uri,
				id: data.lists[i].id,
				name: data.lists[i].name,
				uri: data.lists[i].uri
			});
		}
	}
	
This simply loops through the contact lists that have been returned and stores them in the global list `CONTACTLISTS`.

Update Survey Details
`````````````````````
We will update the survey details to include a link to our list of contact lists.

.. code-block:: javascript

	markup = "<h3>Created by "+survey.creator+" on "+survey.created_at+"
		</h3><a href=\"#\" id=\"responses\">View "+survey.responses+
			" Responses<a><br /><br /><a href='#' id='displayContactLists'>
				Send Invites</a><br /><br /><a href=\""+survey.deploy+"\">
					Take the Survey</a><br /><br /><a href='./'>&larr;&nbsp;Surveys</a>";
	
	// ...
	
	$('#displayContactLists').on('click',function(){
				console.log('clicked');
				showContactLists();
				return false;
	});
	
And the `showcontactLists` function which will display a simple unordered list of our contact lists:

.. code-block:: javascript

	function showContactLists(){
	//renders the contact lists to the page
	var lists = $('<ul id="#contactlists" />'), markup = '';
	
	for(var i=0; i<CONTACTLISTS.length; i++){
		markup += '<li><a href="#" id="c_'+CONTACTLISTS[i].id+'">'
			+ CONTACTLISTS[i].name + "</a></li>";
		}
	lists.html(markup).on('click','a',function(){
		sendEmail(this.id.substring(2));	//parse the actual ID from the DOM ID
	});
	
	$('#content').html(lists);
}

Send the Email
``````````````
Finally, we get to `POST` something.  In the showContactLists function above we attached a function called `sendEmail` to fire when a contact list is clicked.
In order to create an email we POST our message data to `/emails/?survey=:surveyid`.  Once the email has been created our POST request will return a` recipients_uri` that we can use to add our contact list.  Finally, once that has been done we can use the `send_uri` returned from creating the email to actually send it.

.. code-block:: javascript

	function sendEmail(contactlist){
		//we are going to send an email to contactlist but first we need to create the
		// email, once this is done we attach our contact list, and once that is done
		// we send the email
		callAPI('POST',base+'/emails/?survey='+SURVEY,'{"message":"Hello Friends! 
			[Invite Link]", "sender":"John <johndoe@example.com>", "subject": 
			"Hello World"}', function(email){
			//once the email has been created, we add the contactlist to the email
			callAPI('POST', email.recipients_uri, {'contact_list': contactlist}, 
				function(){
				//once the contactlist has been added to the email, 
				//we are ready to send!
				callAPI('POST', email.send_uri, '', function(){
					//once the email has been sent, notify the user
					//and take them back to the survey details
					alert('Your email will be sent shortly!');
					showSurvey('s'+SURVEY);
				});
			});	
		});
	}

We build the email by passing in a set of values for the subject, sender, and email.  You might want to collect these from inputs that the user has filled in.  Be sure to include the string `[Invite Link]` in the message field or else it won't work!  This is replaced with the URL to the survey when the email gets sent. If all goes well you should see an email in your Reminders/History that is schedules to go out shortly to your contacts on the chosen contact list!

View the source on `Github <https://github.com/chideit/fluidsurveys-docs/tree/master/samples/tutorial/part2>`_
