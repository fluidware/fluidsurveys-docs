Webhooks API
=====================

The webhooks API allows you to create and delete webhooks for automated event notifications.

Introduction
------------

Webhooks provide a way for the user to be informed of the occurence of a FluidSurveys event immediately after the event has occured.
Users will be informed via a ``POST`` request to the callback url they have provided during webhook creation. The ``POST`` request 
contains information specific to the event that has occured.
    

Creation and Deletion
---------------------

Creating and deleting webhooks is possible using two different endpoints described below.
If you wish to modify an existing webhook, you must first delete the existing webhook and 
create a new one. Webhook subscription urls must be unique. We suggest adding ``GET``
variables to the subscription url if you require multiple webhooks to provide callbacks 
to the same endpoint.

Creating a webhook
``````````````````

.. http:post:: /api/v2/webhooks/subscribe/

    Returns a status of ``409`` if a webhook with the subscription url already exists. 
    Returns a status of ``201`` if the webhook was successfully created. 
    Requests must be sent as an :mimetype:`application/json`-encoded dictionary with the required fields ``subscription_url`` and ``event``.
    Additionally, ``survey`` and ``collector`` fields may be provided containing the associated IDs. Their ability to filter the callbacks 
    received is based on the event selected.

    Sample request::

      {
        "subscription_url": "http://fluidsurveys.com/api/v2/callback/",
        "event": "response.completed",
        "survey": 1,
        "collector": 1
      }


Deleting a webhook
``````````````````

.. http:post:: /api/v2/webhooks/unsubscribe/

    Returns a status of ``200`` if the webhook was successfully deleted. Requests must be 
    sent as an :mimetype:`application/json`-encoded dictionary with the required fields ``subscription_url``.
    Alternatively, you can delete a webhook by responding to a webhook callback with a status of ``410``

Available Events
----------------


Survey Created
``````````````

survey.created

    Triggered when a new survey is created on your account.

    Sample callback::

      {
        "survey_name": "New Survey",
        "survey_url": "http://fluidsurveys.com/s/newsurvey/",
        "survey_creator_name": "John Doe",
        "survey_creator_email": "john@example.com"
      }


Survey Response Completed
`````````````````````````

response.completed

    Triggered when a new response is completed. This is account wide, unless a survey 
    is provided when creating the webhook. A collector may also be provided during 
    creation to futher narrow down the callbacks received.

    Sample callback::

      {
        "language": "en",
        "referrer": "https://fluidsurveys.com/s/newsurvey/",
        "created_at": "01/01/2013",
        "survey_name": "New Survey",
        "updated_at": "02/01/2013",
        "survey_url": "https://fluidsurveys.com/s/newsurvey/",
        "score": 0,
        "invite_email": "john@example.com",
        "id": 1
      }


Report Created
``````````````

report.created

    Triggered when a new report is created. This is account wide, unless a survey 
    is provided when creating the webhook.

    Sample callback::

      {
        "report_url": "https://fluidsurveys.com/account/surveys/1/reports/1/",
        "report_creator_name": "John Doe",
        "report_creator_email": "john@example.com",
        "survey_url": "http://fluidsurveys.com/s/newsurvey/"
      }


Contact Created
```````````````

contact.created

   Triggered when a new contact is created. This is account wide.

   Sample callback::

      {
        "name": "John Doe",
        "email": "john@example.com"
      }