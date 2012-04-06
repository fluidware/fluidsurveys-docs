SURVEYS = {};
RESPONSES = [];
CONTACTLISTS = [];
SURVEY = null;
base = 'https://app.fluidsurveys.com/api/v2';
	
$(document).ready(function(){	
	callAPI('GET', base+'/surveys/', '', function(data){
		var markup = '';
		 
		 $.each(data.surveys.reverse(),function(){
		 	markup += '<li><a href="#'+this.id+'">'+this.name+'</a></li>';
		 	SURVEYS['s_'+this.id] = {title: this.name,
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
	
	callAPI('GET', base+'/contact-lists/', '', loadContacts);
	
}); //end of document ready.




