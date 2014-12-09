Introduction
============

The FluidSurveys API is a HTTP REST API which is accessed with Basic Authentication.
You can browse and interact with the API in your browser by visting `this
<https://www.fluidsurveys.com/api/v3/>`_ page.  The following guides will help walk you through the various areas of the API.

Browseable
----------

The new API is fully browsable right in your web browser.  Just visit the `root <https://fluidsurveys.com/api/v3/>`_ in your favourite web browser and you will be able
to click through the entire API, POST data directly from your browser and view the the actual
HTTP responses.

Authentication
--------------

* connect via **HTTPS**
* use `HTTP Basic Authentication <http://en.wikipedia.org/wiki/Basic_access_authentication>`_
* replace `fluidsurveys.com` with your custom domain (if applicable)
* when authenticating from a program you wrote, generate a pre-emptive Authorization header by Base64 encoding "email:password", "email:key", or "key:password" & prepending "Basic ".


Try authenticating at the root endpoint and you should get a result with all the other endpoints::

    curl -u bob@example.com:PASSWORD https://fluidsurveys.com/api/v3/

.. code-block:: json

    {"surveys": "https://fluidsurveys.com/api/v3/surveys/",
     "collectors": "https://fluidsurveys.com/api/v3/collectors/", 
     "contacts": "https://fluidsurveys.com/api/v3/contacts/", 
     "embeds": "https://fluidsurveys.com/api/v3/embeds/", 
     "contact-lists": "https://fluidsurveys.com/api/v3/contact-lists/", 
     "webhooks": "https://fluidsurveys.com/api/v3/webhooks/"}

Data Transfer
-------------

The FluidSurveys API will return a JSON response by default.  If you wish to recieve
a different format, simply append a `format` query paramter to your URI.  Accepted formats are `api`, `csv`, `json`, `xml`, `soap`, & `yaml`.  The `api` format will return the HTML browsable interface.

::

   curl -u bob@example.com:PASSWORD https://fluidsurveys.com/api/v3/?format=xml

.. code-block:: xml

    <?xml version="1.0" encoding="utf-8"?>
    <data>
        <count>1</count>
        <next>null</next>
        <previous>null</previous>
        <results>
            <result>
                <variable id="id">2</variable>
                <variable id="name">The Everything Survey</variable>
                <variable id="number_of_responses">0</variable>
                <variable id="survey_uri">https://fluidsurveys.com/api/v3/surveys/2/</variable>
                <variable id="live">1</variable>
                <variable id="slug">the-everything-survey-v1</variable>
                <variable id="creator">jason</variable>
                <variable id="created_at">2014-02-27 12:55:41+00:00</variable>
                <variable id="updated_at">2014-02-27 12:55:41+00:00</variable>
                <variable id="deploy_url">https://fluidsurveys.com/surveys/jason/the-everything-survey-v1/</variable>
                <variable id="duplicate_uri">https://fluidsurveys.com/api/v3/surveys/2/duplicate/</variable>
                <variable id="send_invite_uri">https://fluidsurveys.com/api/v3/surveys/2/invites/</variable>
                <variable id="responses_uri">https://fluidsurveys.com/api/v3/surveys/2/responses/</variable>
                <variable id="survey_settings_uri">https://fluidsurveys.com/api/v3/surveys/2/settings/</variable>
                <variable id="survey_structure_uri">https://fluidsurveys.com/api/v3/surveys/2/structure/</variable>
                <variable id="collectors_uri">https://fluidsurveys.com/api/v3/surveys/2/collectors/</variable>
                <variable id="invite_codes_uri">https://fluidsurveys.com/api/v3/surveys/2/invite_codes/</variable>
                <variable id="groups_uri">https://fluidsurveys.com/api/v3/surveys/2/groups/</variable>
                <variable id="reports_uri">https://fluidsurveys.com/api/v3/surveys/2/reports/</variable>
                <variable id="csv_uri">https://fluidsurveys.com/api/v3/surveys/2/csv/</variable>
                <variable id="tags_uri">https://fluidsurveys.com/api/v3/surveys/2/tags/</variable>
                <variable id="versions_uri">https://fluidsurveys.com/api/v3/surveys/2/versions/</variable>
                <variable id="questions_uri">https://fluidsurveys.com/api/v3/surveys/2/questions/</variable>
            </result>
        </results>
    </data>

When sending `POST` or `PUT` requests please ensure the `Content-Type` header matches
the content in the body of your request.  We accept both `application/json` and `application/x-www-form-urlencoded` as valid `Content-Type` headers.

Pagination
----------

Collections are paginated with a default size of `10`, which can be overridden by specifying `page_size` in the query string. The maximum page size is `100`.

Surveys Guide
^^^^^^^^^^^^^

Learn how to retrieve, filter, and delete your surveys in the :ref:`survey-guide`.
