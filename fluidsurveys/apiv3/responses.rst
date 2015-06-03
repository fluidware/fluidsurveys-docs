.. _response-guide:

Dealing with Responses
======================

Once your survey has collected some responses, you may want to retrieve the responses over the API.  For other options on how to retrieve responses, see `webhooks <http://docs.fluidsurveys.com/chapters/Publish/settings.html#webhook-example>`_.

List of Responses
-----------------

.. http:get:: /api/v3/surveys/:id/responses/

  :query page: page of responses to return (defaults to 0)
  :query page_size: number of responses to return per page (defaults to 50, max is 200)
  :query ids: list of responses to return based on unique identifiers
  :query expand_GET: whether to format the GET variables as JSON instead of querystring (true, 1, yes, on)
  :query include_url: whether to include a direct url to the response for editing (true, 1, yes, on)
  :query include: list of unique question identifiers to include
  :query filter: name of predefined filter
  :query include_labels: return text of choice labels as opposed to indicies (true, 1, yes, on)
  :query include_id: include user-defined question identifiers (true, 1, yes, on)
  :query include_key: include unique identifier for each response (true, 1, yes, on)
  :query show_titles: include question titles (true, 1, yes, on)
  :query score_based: export scores instead of labels (true, 1, yes, on)
  :query escape_newline: replace newline characters with \n (true, 1, yes, on)
  :query tab_separated: Excel compatible (true, 1, yes, on)
  :query comma_separated: export as a CSV file (true, 1, yes, on)
  :query strip_html: remove all HTML tags from exported answers (true, 1, yes, on)
  :query inverted: export questions on separate rows for database import (true, 1, yes, on)
  :query include_response_link: include edit links for each response (true, 1, yes, on)
  
::

  curl -u bob@example.com:PASSWORD \
  https://fluidsurveys.com/api/v3/surveys/346176/responses/

.. code-block:: json

    {"count": 2,
     "next": null,
     "previous": null,
     "results": [{"response_uri": 
      "https://fluidsurveys.com/api/v3/surveys/346176/responses/32693680/",
     "_locale": 218,
     "_updated_at": "2013-11-05T20:37:33",
     "_key": "f6aa30187a39a5e8db9869421a87d7d50929074f",
     "0nptXmOatp": "Hello World",
     "u53cTNZRPK": 0,
     "_username": "api_bob",
     "_ip_address": "99.240.216.217",
     "_created_at": "2013-11-05T20:37:33",
     "_weighted_score": 1,
     "_referrer": "http://fluidsurveys.com/surveys/api_bob/demo-survey/",
     "_completed": 1,
     "_language": "en",
     "_id": 32693680},
     {"response_uri": 
      "https://fluidsurveys.com/api/v3/surveys/346176/responses/32693698/",
     "_locale": 218,
     "_updated_at": "2013-11-05T20:37:42",
     "_key": "5887a8159d0d6dcc31c10f2226c0d4832377a447",
     "0nptXmOatp": "The next frontier",
     "u53cTNZRPK": 1,
     "_username": "api_bob",
     "_ip_address": "99.240.216.217",
     "_created_at": "2013-11-05T20:37:42",
     "_weighted_score": 2,
     "_referrer": "http://fluidsurveys.com/surveys/api_bob/demo-survey/",
     "_completed": 1,
     "_language": "en",
     "_id": 32693698}]
    }

Creating a New Response
-----------------------

In order to set the value of a response, you need to know the question id.  See more about question id in INSERT LINK Advanced Survey Details.  You may include any number of question ids in your request, including zero.  In which case a blank response will be created.

If successful, the response you recieve will include three values.  `url` which is a survey url that can be used by an end user to complete the survey.  This is useful if you want to control access to the survey and tie the response back to your own system.  The `key` and `id` are used to uniquely identify the response.

.. http:post:: /api/v3/surveys/:id/responses/

  :form \:question_id: value of response to `:question_id`
  :form \:quesiton_id\\\\other: to store an other choice text field (include `quesiton_id`:other_choice_value as well)
  
::

  curl -u bob@example.com:PASSWORD -d "0nptXmOatp=my response" \
  https://fluidsurveys.com/api/v3/surveys/346176/responses/ 

.. code-block:: json

    {"url": "http://fluidsurveys.com/surveys/api_bob/
      demo-survey/94d99cc502b79cdb73d3eae8b942c29d72d7c575/",
     "id": 33021642,
     "key": "94d99cc502b79cdb73d3eae8b942c29d72d7c575"
    }

Editing a Response
------------------

.. http:put:: /api/v3/surveys/:id/responses/:response_id/

  :form \:question_id: value of response to `:question_id`
  :form \:quesiton_id\\\\other: to store an other choice text field (include `quesiton_id`:other_choice_value as well)

To edit a response, send a `PUT` request to the response detail endpoint.  For example, too add a value for another question on the response above:

::

  curl -u bob@example.com:PASSWORD -X PUT -d "u53cTNZRPK=0" \
  https://fluidsurveys.com/api/v3/surveys/346176/responses/33021642/ 

.. code-block:: json

     "OK"
  
You will recieved a response with status code `202` and "OK" if succesful.

Filtering Responses
-------------------

.. http:get:: /api/v3/surveys/:id/responses/

  :query \:question_id: value of response to `:question_id`
  :query filter: name of predefined filter


To see that our response has been updated with the new value lets query for it.  In this case the question id was `u53cTNZRPK`.

::

  curl -u bob@example.com:PASSWORD \
  https://fluidsurveys.com/api/v3/surveys/346176/responses/?u53cTNZRPK=0

The response shows two results (there was already one response with `u53cTNZRPK=0` before we started) and we can verify the second response has the `id` we used when editing.

.. code-block:: json

    {"count": 2,
     "next": null,
     "previous": null,
     "results": [{"response_uri":
       "https://fluidsurveys.com/api/v3/surveys/346176/responses/32693680/",
     "_locale": 218,
     "_updated_at": "2013-11-05T20:37:33",
     "_key": "f6aa30187a39a5e8db9869421a87d7d50929074f",
     "0nptXmOatp": "Hello World",
     "u53cTNZRPK": 0,
     "_username": "api_bob",
     "_ip_address": "99.240.216.217",
     "_get_variables": null,
     "_created_at": "2013-11-05T20:37:33",
     "_weighted_score": 1,
     "_referrer": "http://fluidsurveys.com/surveys/api_bob/demo-survey/",
     "_completed": 1,
     "_pagepath": null,
     "_language": "en",
     "_id": 32693680},
     {"response_uri": "https://fluidsurveys.com/api/v3/surveys/346176/responses/33021642/",
     "_locale": null,
     "_updated_at": "2013-11-08T19:39:15",
     "_key": "94d99cc502b79cdb73d3eae8b942c29d72d7c575",
     "0nptXmOatp": "my response",
     "u53cTNZRPK": 0,
     "_username": "api_bob",
     "_ip_address": "0.0.0.0",
     "_get_variables": "IMPORTED&",
     "_created_at": "2013-11-08T19:39:15",
     "_weighted_score": "",
     "_referrer": null,
     "_completed": 0,
     "_pagepath": "",
     "_language": "",
     "_id": 33021642}]
    }

Date Filters
^^^^^^^^^^^^

To filter by date use either the `_created_at` or `_updated_at` meta variable with one of the following predicates: `=`, `<`, or `>` and the date in the format: `YYYY-MM-DD`

::

  curl -u bob@example.com:PASSWORD \
  'https://fluidsurveys.com/api/v3/surveys/346176/responses/?_created_at>2013-11-04'

Will return all responses created after November 4th.

You can also create more advanced filters via the web interface of FluidSurveys. If you save a custom filter in the application you can use it via the API by specificying the `filter` query parameter and providing the name of the filter you created.  *These filters are on a per-survey basis*.

CSV Filters
^^^^^^^^^^^

You can use the same filtering methods above when generating a CSV file.

::
    
  curl -u bob@example.com:PASSWORD \
  'https://fluidsurveys.com/api/v3/surveys/346176/csv/?_created_at>2013-11-04'




