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

.. _survey-details:

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
