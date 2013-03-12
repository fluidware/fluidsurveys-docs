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
        "event": "response_complete",
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

survey_create

    Triggered when a new survey is created on your account.

    Sample callback::

	POST /your-survey-callback HTTP/1.1
	User-Agent: python-requests/0.14.2 CPython/2.7.2 Darwin/12.3.0
	Host: requestb.in
	Content-Type: application/x-www-form-urlencoded
	Content-Length: 165
	Connection: close
	Accept-Encoding: gzip, deflate, compress
	Accept: */*

	survey_creator_name=&survey_name=MADE+A+NEW+SURVEY&survey_creat
	or_email=bob@example.com&survey_url=http%3A%2F%2Fexample.com%2
	Fsurveys%2Fbob%2Fmade-a-new-survey%2F


Survey Response Completed
`````````````````````````

response_complete

    Triggered when a new response is completed. This is account wide, unless a survey 
    is provided when creating the webhook. A collector may also be provided during 
    creation to futher narrow down the callbacks received.

    Sample callback::

	POST /your-response-callback HTTP/1.1
	User-Agent: python-requests/0.14.2 CPython/2.7.2 Darwin/12.3.0
	Host: requestb.in
	Content-Type: application/x-www-form-urlencoded
	Content-Length: 255
	Connection: close
	Accept-Encoding: gzip, deflate, compress
	Accept: */*

	score=0&invite_email=N%2FA&language=en&referrer=http%3A%2F%2Ffl
	uidsurveys.com%2Faccount%2F&created_at=26%2F03%2F2013+02
	%3A26PM&survey_name=m3&updated_at=26%2F03%2F2013+02%3A26PM&surv
	ey_url=http%3A%2F%2Fexample.com%2Fsurveys%2Fbob%2Fm3-1%2F&id=
	276


Report Created
``````````````

report_create

    Triggered when a new report is created. This is account wide, unless a survey 
    is provided when creating the webhook.

    Sample callback::

	POST /your-report-callback HTTP/1.1
	User-Agent: python-requests/0.14.2 CPython/2.7.2 Darwin/12.3.0
	Host: requestb.in
	Content-Type: application/x-www-form-urlencoded
	Content-Length: 190
	Connection: close
	Accept-Encoding: gzip, deflate, compress
	Accept: */*

	report_url=%2Faccount%2Fsurveys%2F230%2Freports%2F7%2F&report_
	creator_name=&report_creator_email=bob@example.com&survey_url
	=http%3A%2F%2Fexample.com%2Fsurveys%2Fbob%2Fmade-a-new-surve
	y%2F


Contact Created
```````````````

contact_create

   Triggered when a new contact is created. This is account wide.

   Sample callback::

	POST /your-contact-callback HTTP/1.1
	User-Agent: python-requests/0.14.2 CPython/2.7.2 Darwin/12.3.0
	Host: requestb.in
	Content-Type: application/x-www-form-urlencoded
	Content-Length: 30
	Connection: close
	Accept-Encoding: gzip, deflate, compress
	Accept: */*

	name=Joe&email=joe%40example.com
	
