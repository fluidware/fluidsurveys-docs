.. _survey-guide:

Surveys Guide
=============

Retrieve a List of Surveys
--------------------------

.. http:get:: /api/v3/surveys/

  :query search: a string to search for in the survey name.
  :query group: id or name that the survey belongs to.
  :query tags: tag name.

::
 
  curl -u bob@example.com:PASSWORD https://fluidsurveys.com/api/v3/surveys/

.. code-block:: json

   {
   "count": 1,
   "next": null,
   "previous": null,
   "results": [{"id": 346176,
     "name": "Demo Survey",
     "number_of_responses": 2,
     "survey_uri": "https://fluidsurveys.com/api/v3/surveys/346176/",
     "live": 1,
     "slug": "demo-survey",
     "creator": "https://fluidsurveys.com/api/v3/users/2127285426/",
     "created_at": "2013-11-05T20:37:07Z",
     "updated_at": "2013-11-05T20:37:21Z",
     "deploy_url": "http://fluidsurveys.com/surveys/api_bob/demo-survey/",
     "duplicate_uri": "https://fluidsurveys.com/api/v3/surveys/346176/duplicate/",
     "send_invite_uri": "https://fluidsurveys.com/api/v3/surveys/346176/invites/",
     "responses_uri": "https://fluidsurveys.com/api/v3/surveys/346176/responses/",
     "survey_settings_uri": "https://fluidsurveys.com/api/v3/surveys/346176/settings/",
     "survey_structure_uri": "https://fluidsurveys.com/api/v3/surveys/346176/structure/",
     "collectors_uri": "https://fluidsurveys.com/api/v3/surveys/346176/collectors/",
     "invite_codes_uri": "https://fluidsurveys.com/api/v3/surveys/346176/invite_codes/",
     "groups_uri": "https://fluidsurveys.com/api/v3/surveys/346176/groups/",
     "reports_uri": "https://fluidsurveys.com/api/v3/surveys/346176/reports/",
     "csv_uri": "https://fluidsurveys.com/api/v3/surveys/346176/csv/",
     "tags_uri": "https://fluidsurveys.com/api/v3/surveys/346176/tags/",
     "versions_uri": "https://fluidsurveys.com/api/v3/surveys/346176/versions/",
     "questions_uri": "https://fluidsurveys.com/api/v3/surveys/346176/questions/"}
    ]
   }


Create a New Survey
-------------------

.. http:post:: /api/v3/surveys/
  
  *(\* denotes required parameters)*

  :form name*: name of new survey
  :form live: `0` (closed) or `1` (open)

::

  curl -u bob@example.com:PASSWORD -d "name=My New Survey" \
  https://fluidsurveys.com/api/v3/surveys/

.. code-block:: json

  {"id": 346290,
  "name": "My New Survey",
  "number_of_responses": 0,
  "survey_uri": "https://fluidsurveys.com/api/v3/surveys/346290/",
  "live": 1,
  "slug": "my-new-survey",
  "creator": "https://fluidsurveys.com/api/v3/users/2127285426/",
  "created_at": "2013-11-05T21:34:33.227Z",
  "updated_at": "2013-11-05T21:34:33.227Z",
  "deploy_url": "http://fluidsurveys.com/surveys/api_bob/my-new-survey/",
  "duplicate_uri": "https://fluidsurveys.com/api/v3/surveys/346290/duplicate/",
  "send_invite_uri": "https://fluidsurveys.com/api/v3/surveys/346290/invites/",
  "responses_uri": "https://fluidsurveys.com/api/v3/surveys/346290/responses/",
  "survey_settings_uri": "https://fluidsurveys.com/api/v3/surveys/346290/settings/",
  "survey_structure_uri": "https://fluidsurveys.com/api/v3/surveys/346290/structure/",
  "collectors_uri": "https://fluidsurveys.com/api/v3/surveys/346290/collectors/",
  "invite_codes_uri": "https://fluidsurveys.com/api/v3/surveys/346290/invite_codes/",
  "groups_uri": "https://fluidsurveys.com/api/v3/surveys/346290/groups/",
  "reports_uri": "https://fluidsurveys.com/api/v3/surveys/346290/reports/",
  "csv_uri": "https://fluidsurveys.com/api/v3/surveys/346290/csv/",
  "tags_uri": "https://fluidsurveys.com/api/v3/surveys/346290/tags/",
  "versions_uri": "https://fluidsurveys.com/api/v3/surveys/346290/versions/",
  "questions_uri": "https://fluidsurveys.com/api/v3/surveys/346290/questions/"}

Edit a Survey
-------------

.. http:PUT:: /api/v3/surveys/:id/

  :form name: name of new survey
  :form live: `0` (closed) or `1` (open)

::

  curl -u bob@example.com:PASSWORD -X PUT -d "name=new name" \
  https://fluidsurveys.com/api/v3/surveys/346290/

.. code-block:: json

  {"id": 346290,
   "name": "new name",
   "number_of_responses": 0,
   "survey_uri": "https://fluidsurveys.com/api/v3/surveys/346290/",
   "live": 1,
   "slug": "my-new-survey",
   "creator": "https://fluidsurveys.com/api/v3/users/2127285426/",
   "created_at": "2013-11-05T21:34:33Z",
   "updated_at": "2013-11-06T20:25:18.039Z",
   "deploy_url": "http://fluidsurveys.com/surveys/api_bob/my-new-survey/",
   "duplicate_uri": "https://fluidsurveys.com/api/v3/surveys/346290/duplicate/",
   "send_invite_uri": "https://fluidsurveys.com/api/v3/surveys/346290/invites/",
   "responses_uri": "https://fluidsurveys.com/api/v3/surveys/346290/responses/",
   "survey_settings_uri": "https://fluidsurveys.com/api/v3/surveys/346290/settings/",
   "survey_structure_uri": "https://fluidsurveys.com/api/v3/surveys/346290/structure/",
   "collectors_uri": "https://fluidsurveys.com/api/v3/surveys/346290/collectors/",
   "invite_codes_uri": "https://fluidsurveys.com/api/v3/surveys/346290/invite_codes/",
   "groups_uri": "https://fluidsurveys.com/api/v3/surveys/346290/groups/",
   "reports_uri": "https://fluidsurveys.com/api/v3/surveys/346290/reports/",
   "csv_uri": "https://fluidsurveys.com/api/v3/surveys/346290/csv/",
   "tags_uri": "https://fluidsurveys.com/api/v3/surveys/346290/tags/",
   "versions_uri": "https://fluidsurveys.com/api/v3/surveys/346290/versions/",
   "questions_uri": "https://fluidsurveys.com/api/v3/surveys/346290/questions/"}

Next up, check out out our guide to :ref:`response-guide`.