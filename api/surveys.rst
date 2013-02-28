Surveys API
===========

The REST API is accessed through HTTPS with Basic authentication using the user's API key
and password.

Getting a list of surveys
`````````````````````````

.. http:get:: /api/v2/surveys/

    Returns surveys that are accessible to the currently authenticated user. This method
    returns data in :mimetype:`application/json` format.

    Sample response: ::

	{
	  "total": 1,
	  "surveys": [{
	    "id": 17461,
	    "uri": "https://fluidsurveys.com/api/v2/surveys/17461/",
	    "deploy_uri": "http://fluidsurveys.com/s/test-survey/",
	    "responses": 10,
	    "creator": "username",
	    "name": "survey name"
	  }]
	}


Survey Status
`````````````

.. http:get:: /api/v2/surveys/:id/status/

	Returns a JSON object with status either "live" or "closed".
	
    Sample response: ::

	{
		"status" : "live"
	}

.. http:post:: /api/v2/surveys/:id/status/

	Toggles the survey status from *closed* to *live* and vice versa.
	Optionally, you can pass a switch parameter with the value `closed` or `live` to set it to a specific status.
	
.. http:post:: /api/v2/surveys/:id/status/?switch=closed


Creating an empty Survey
````````````````````````

.. http:post:: /api/v2/surveys/

    :form name: The name for the new survey to create.

    Creates an empty survey with `GET` parameter `name`.
	
    Sample response: ::

	{
	  "id": XXXXX,
	  "name": "New Survey",
	  "uri": "http://fluidsurveys.com/api/v2/surveys/XXXXX/",
	  "deploy_uri": "http://fluidsurveys.com/surveys/username/new-survey/",
	  "report_url": "http://fluidsurveys.com/account/surveys/XXXXX/reports/",
	  "responses_url": "http://fluidsurveys.com/account/surveys/XXXXX/responses/",
	  "edit_url": "http://fluidsurveys.com/account/surveys/XXXXX/edit/"
	}
	
Creating a Survey with your own JSON
````````````````````````````````````

You can define your own survey by writing the JSON your self.  This is an advanced topic and your should be comfortable working with
JSON before you attempt to create your own surveys.

If you're ready, check out out the details: :ref:`survey-json`

Duplicating an Existing Survey
``````````````````````````````

.. http:post:: /api/v2/surveys/:id/duplicate/

    :form name: The name to set on the duplicate survey

    Duplicating a survey will create a new survey with the same set of questions, styles, and reports.

    Sample response: ::

	{
	  "id": XXXXX,
	  "name": "Duplicate Survey",
	  "uri": "http://fluidsurveys.com/api/v2/surveys/XXXXX/",
	  "deploy_uri": "http://fluidsurveys.com/surveys/username/duplicate-survey/",
	  "report_url": "http://fluidsurveys.com/account/surveys/XXXXX/reports/",
	  "responses_url": "http://fluidsurveys.com/account/surveys/XXXXX/responses/",
	  "edit_url": "http://fluidsurveys.com/account/surveys/XXXXX/edit/"
	}

Renaming an Existing Survey
```````````````````````````

.. http:post:: /api/v2/surveys/:id/rename/

    :form name: The new name to set on the survey

    Renaming a survey will only affect the survey name for display purposes.

    Sample response: ::

	{
	  "id": XXXXX,
	  "name": "Renammed Survey",
	  "uri": "http://fluidsurveys.com/api/v2/surveys/XXXXX/",
	  "deploy_uri": "http://fluidsurveys.com/surveys/username/duplicate-survey/",
	  "report_url": "http://fluidsurveys.com/account/surveys/XXXXX/reports/",
	  "responses_url": "http://fluidsurveys.com/account/surveys/XXXXX/responses/",
	  "edit_url": "http://fluidsurveys.com/account/surveys/XXXXX/edit/"
	}

Deleting a Survey
`````````````````

.. http:delete:: /api/v2/surveys/:id/

	Be careful!  This will delete your survey.


Getting survey details
``````````````````````

.. http:get:: /api/v2/surveys/:id/

    Returns summary details about the specified survey. This method returns data in
    :mimetype:`application/json` format.

    Sample response: ::

	{
	  "id": 17461,
	  "uri": "https://fluidsurveys.com/api/v2/surveys/17461/",
	  "deploy_uri": "http://fluidsurveys.com/s/test-survey/",
	  "responses": 10,
	  "creator": "username",
	  "name": "survey name",
	  "title": "survey title",
	  "description": "survey description",
	  "variables": {
	    "var1": {
	      "type": "string",
	      "label": "Question 1"
	    }
	  }
	}
	
You may also send a GET parameter called `structure` to receive the entire survey object.
	
.. http:get:: /api/v2/surveys/:id/?structure

    This may be useful if you require advanced information such as if a question is required or not. 


Survey Collectors
`````````````````

	You can view, add, and delete survey collectors at the following end points:

.. http:get:: /api/v2/surveys/:id/collectors/

	Returns a list of collectors on the survey.

.. http:post:: /api/v2/surveys/:id/collectors/?name=New Collector

	Creates a new collector for the survey with `name`.

.. http:delete:: /api/v2/surveys/:id/collectors/?id=:collector_id

	Deletes the collector with `id` *:collector_id* from the survey.


Survey Reports
``````````````
	
	You can view, and modify information pertaining to reports at the following end points:

.. http:get:: /api/v2/surveys/:id/reports/

   Sample response: ::

	{
	  "count": 1,
	  "reports_url": "http://fluidsurveys.com/account/surveys/325/reports/",
	  "sharing_password": null,
	  "reports": [
	    {
	      "report_url": "http://fluidsurveys.com/account/surveys/325/reports/162/",
	      "id": 162,
	      "title": "Summary Report"
	    }
	  ]
	}

.. http:post:: /api/v2/surveys/:id/reports/
	
	:form sharing_password: A password to set for report sharing.

	This method allows you to modify parameters for reports in general. Currently, the
	only supported action is to set a sharing password for the report-list page. Passing in
	a value for	the `sharing_password` parameter will enable sharing on the reports page. 
	Passing in this parameter with an empty value will disable sharing from the reports page.


Getting survey responses
````````````````````````

.. http:get:: /api/v2/surveys/:id/responses/[:response_id/]

    Returns a list of responses to the specified survey that are accessible to the
    currently authenticated user. Pagination is supported through the `offset` and
    `limit` query parameters. This method returns data in :mimetype:`application/json`
    format. The `response_id` parameter is optional, and, if provided, will limit the 
    output to the singular response indicated.

    :query offset: response pagination offset (defaults to 0).
    :query limit: maximum number of results to return (defaults to 50 max is 200).
    :query filter: name of the filter you wish to filter responses by
    :query expand_GET: whether to format the GET variables as JSON instead of querystring.
    :query include_url: whether to include a direct url to the response (for editing).

    Examples:

.. http:get:: /api/v2/surveys/:id/responses/?filter=myfilter

    Filters are created from the web interface and are on a **per-survey basis**.  
    You may also use one of the pre-defined filters: *completed*, *invite_emails*, 
    or *invite_codes*.


    Sample response: ::

	{
	  "count": 2,
	  "total": 2,
	  "responses": [{
	    "_id": XXXX,
	    "_completed": 0,
	    "_ip_address": "0.0.0.0",
	    "_get_variables": "var1=1&var2=2&var3"
	  }, {
	    "_id": XXXY,
	    "_completed": 1,
	    "_ip_address": "0.0.0.0"
	  }],
	}

.. http:get:: /api/v2/surveys/:id/responses/XXXX/?expand_GET

    The `_get_variables` field which specifies the query-string that users entered 
    the survey with are expanded out as a JSON dictionary.

    Sample response: ::

	{
	  "count": 1,
	  "total": 2,
	  "responses": [{
	    "_completed": 0,
	    "_ip_address": "0.0.0.0",
	    "_get_variables": {
	      "var1": "1",
	      "var2": "2",
	      "var3": ""
	    }
	  }]
	}


.. http:get:: /api/v2/surveys/:id/responses/?_invite_code=XXXXX

    You can also filter by any one of the response variables directly. In this example 
    we filter by a specific invite code through the meta-variable `_invite_code`.

    Sample response: ::

	{
	  "count": 1,
	  "total": 2,
	  "responses": [{
	    "_completed": 1,
	    "_invite_code": "XXXXX"
	    "_ip_address": "0.0.0.0",
	    "_get_variables": "code=XXXXX"
	  }]
	}


Creating a new response
```````````````````````

.. http:post:: /api/v2/surveys/:id/responses/

    Creates a new response to the survey specified by ``id``.


Changing Response Status and Collector
``````````````````````````````````````

	If you have existing responses that you want to assign to a new collector and change from complete to incomplete you may do with the following end point.

.. http:post:: /api/v2/surveys/:id/responses/:response_id/?completed=:status&collector=:collector_id

	Where :status is either `1` or `true` for complete or `0` or `false` for incomplete.


Submitting a new response
`````````````````````````

.. http:post:: /api/v2/surveys/:id/responses/

    *Note:* Submitting responses currently only works on single page surveys.

    Submits a new response.  Send a post request as *application/json* with a dictionary of question ids and response values.

    You will get a ``{success:true, id:response_id}`` response if your request was successful.

    If there is an error, the sever will return a **status code 500** with JSON:

    Example: ::

	import requests, json
	uri = 'https://fluidsurveys.com/api/v2/survey/55023/responses/'
	API_KEY = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
	PASSWORD = 'password'
	headers = {'Content-Type': 'application/json'}
	payload = {'DiBzfaXB6b': '3'}	#must post strings
	r = requests.post(uri,data=json.dumps(payload), 
		headers=headers, auth=(API_KEY,PASSWORD))
	response = r.content	

    Sample response: ::

	{
	  "code": "survey_error",
	  "description": [
	                  ["DiBzfaXB6b", "'3' is not a valid choice for this field"],
	                  ["5yEXFv1Bob", "An answer to this question is required."]
	                 ]
	}

    You can also send a standard *application/x-www-form-urlencoded* POST request.  e.g. ::

	5yEXFv1Bob=hello%20world&zIthHJ9tvZ=0&DiBzfaXB6b=1

Uploading a CSV
```````````````

	You may also wish to import responses to a survey using a CSV file.  However you should first be familiar with the export/import tool in FluidSurveys.  *Use the Include identifiers in headers (for response import)* option to export your responses.  Alternatively, you will need the response importer template.  Which can be found be going responses section and choosing *Import Responses* from the action menu.  Download the CSV template. (an api call for this will be coming soon!).

	Once the CSV file is filled out you can send it as a POST request to:
.. http:post:: /api/v2/surveys/:id/responses/

	You **must** also set the Content-Type to `text/csv`


Deleting responses
``````````````````

.. http:delete:: /api/v2/surveys/:id/responses/

    Deletes response(s) to the survey specified by ``id``.

    :query response_ids: a "``+``"-separated list of response identifiers to be deleted.

Getting responses as a CSV
``````````````````````````

.. http:get:: /api/v2/surveys/:id/csv/

    Returns details about the specified survey.

Sending a new invitation
````````````````````````

.. http:post:: /api/v2/surveys/:id/send-survey/

    Creates a new contact or finds an existing contact matching the name and email provided, and sends an survey invitation to them. Data must be sent as an :mimetype:`application/json`-encoded
    dictionary, which must included the fields ``name``, ``email``, ``subject``, ``sender``, and ``message``.

    ``Sender`` must be in the form ``"Name <email@example.com>"`` and ``message`` must include the string "``[Invite Link]``" in it.  This token is replaced with the URL at which the recipient may take the survey.

    Sample request::

      {
    "name": "Jane Doe",
	"email": "jane@google.com",
	"subject": "Email subject",
	"sender_name": "John Doe",
	"sender_email": "john@google.com"
	"message": "Dear [Full Name],\n\nMessage body: [Invite Link]"
      }

    Returns details about the send invitation.
