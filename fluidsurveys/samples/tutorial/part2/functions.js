//Functions for our basic AJAX web app demo on FluidSurveys API.

function callAPI(type,url,data,callback){
	//our AJAX function that calls our proxy
	
	var proxy = 'http://www.speg.com/chideit/proxy/proxy.php?method=';

	var j = $.ajax({
			beforeSend: function(xhr){
				if(typeof(data) === 'string' && data.lastIndexOf('{', 0) === 0){xhr.setRequestHeader('Content-Type', 'application/json');}
				else {xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');}	
			},
			url: proxy+url,
			type: type,
			data: data,
			success: function(data){
				//since the API always returns JSON - we will parse the data right here and pass it to callback
				callback(JSON.parse(data));
			},
			error: function(event, jqXHR, ajaxSettings, thrownError){
				console.log(event, jqXHR, ajaxSettings, thrownError);
			}
		});		
}

function showSurvey( url ){

	var surveyID = url.substring(1),

		survey = SURVEYS[ 's_'+surveyID ];
	
	if ( survey ) {
		SURVEY = survey.id;
		markup = "<h3>Created by "+survey.creator+" on "+survey.created_at+".</h3><a href=\"#\" id=\"responses\">View "+survey.responses+" Responses<a><br /><br /><a href='#' id='displayContactLists'>Send Invites</a><br /><br /><a href=\""+survey.deploy+"\">Take the Survey</a><br /><br /><a href='./'>&larr;&nbsp;Surveys</a>";
				
		callAPI('GET',base+'/surveys/'+survey.id+'/responses/', '',  function(data){
			//add each of the responses to the responses list.
			RESPONSES = [];
			$.each(data.responses,function(i,response){
				re = [];
				$.each(response,function(key,value){
					if(key.lastIndexOf('_', 0) === 0){
						//this is a property of the response, ignore for now.
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
			return false;
		});
		$('#displayContactLists').on('click',function(){
			console.log('clicked');
			showContactLists();
			return false;
		});
		
	}
}

function showResponses(){
	//displays the currentley stored RESPONSES
	
	if ( RESPONSES ) {
		var markup = "",
			numItems = RESPONSES.length;
		
		// Generate a list for each response.
		for ( var i = 0; i < numItems; i++ ) {
		 	markup += "<ul>";
		 	var questions = RESPONSES[i].length;
		 	
		 	//Generate a list item for each answer in the response.
		 	for (var j = 0; j < questions; j++){
		 		markup += "<li>" + RESPONSES[i][j].id + " : "+RESPONSES[i][j].value+"</li>";
		 	}
		 	markup += "</ul>"
		 }
		 
		 markup += "<a href=\"./\">&larr;&nbsp;Surveys</a>";
		$( "h1" ).html( 'Responses' );
		$("#content").html(markup);
	}
}

function loadContacts(data){
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

function showContactLists(){
	//renders the contact lists to the page
	var lists = $('<ul id="#contactlists" />'), markup = '';
	
	for(var i=0; i<CONTACTLISTS.length; i++){
		markup += '<li><a href="#" id="c_'+CONTACTLISTS[i].id+'">'+CONTACTLISTS[i].name+"</a></li>";
		}
	lists.html(markup).on('click','a',function(){
		sendEmail(this.id.substring(2));
	});
	
	$('#content').html(lists);
}

function sendEmail(contactlist){
	//we are going to send an email to contactlist but first we need to create the email, once this is done we attach our contact list, and once that is done we send the
	callAPI('POST',base+'/emails/?survey='+SURVEY,'{"message":"Hello Friends! [Invite Link]", "sender":"Steve <steve@speg.com>", "subject": "Hello World"}', function(email){
		//once the email has been created, we add the contactlist to the email
		callAPI('POST', email.recipients_uri, {'contact_list': contactlist}, function(){
			//once the contactlist has been added to the email, we are ready to send!
			callAPI('POST', email.send_uri, '', function(){
				//once the email has been sent, notify the user and take them back to the survey details
				alert('Your email will be sent shortly!');
				showSurvey('s'+SURVEY);
			});
		});	
	});
}

