//Functions for our basic AJAX web app demo on FluidSurveys API.

function callAPI(type,url,callback){
	//our AJAX function that calls our proxy
	//for PART I: only need to do GET requests
	
	var proxy = 'http://www.yourdomain.com/proxy.php?method=';

	var j = $.ajax({
			beforeSend: function(xhr){
				xhr.setRequestHeader('Content-Type', 'application/json');	
			},
			url: proxy+url,
			type: type,
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

		markup = "<h3>Created by "+survey.creator+" on "+survey.created_at+".</h3><a href=\"#\" id=\"responses\">View "+survey.responses+" Responses<a><br /><br /><a href=\""+survey.deploy+"\">Take the Survey</a><br /><br /><a href='./'>&larr;&nbsp;Surveys</a>";
				
		callAPI('GET',base+'/surveys/'+survey.id+'/responses/', function(data){
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