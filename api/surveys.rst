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
	    "uri": "https://app.fluidsurveys.com/api/v2/surveys/17461/",
	    "deploy_uri": "http://app.fluidsurveys.com/s/test-survey/",
	    "responses": 10,
	    "creator": "username",
	    "name": "survey name"
	  }]
	}

Getting survey details
``````````````````````

.. http:get:: /api/v2/surveys/:id/

    Returns details about the specified survey. This method returns data in
    :mimetype:`application/json` format.

    Sample response: ::

	{
	  "id": 17461,
	  "uri": "https://app.fluidsurveys.com/api/v2/surveys/17461/",
	  "deploy_uri": "http://app.fluidsurveys.com/s/test-survey/",
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

Getting survey responses
````````````````````````

.. http:get:: /api/v2/surveys/:id/responses/

    Returns a list of responses to the specified survey that are accessible to the
    currently authenticated user. Pagination is supported through the `offset` and
    `limit` query parameters. This method returns data in :mimetype:`application/json`
    format.

    :query offset: response pagination offset (defaults to 0).
    :query limit: maximum number of results to return (defaults to 10).

    Sample response: ::

	{
	  "total": 2,
	  "responses": [{
	    "_completed": 0,
	    "_ip_address": "0.0.0.0"
	  }, {
	    "_completed": 1,
	    "_ip_address": "0.0.0.0"
	  }]
	}

Creating a new response
```````````````````````

.. http:post:: /api/v2/surveys/:id/responses/

    Creates a new response to the survey specified by ``id``.

Deleting responses
``````````````````

.. http:delete:: /api/v2/surveys/:id/responses/

    Deletes response(s) to the survey specified by ``id``.

    :query response_ids: a "``+``"-separated list of response identifiers to be deleted.

Getting responses as a CSV
``````````````````````````

.. http:get:: /api/v2/surveys/:id/csv/

    Returns details about the specified survey.
