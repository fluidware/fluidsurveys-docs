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
a different format, simply append a `format` query paramter to your URI.  Accepted formats include `xml` and `yaml`.

::

   curl -u bob@example.com:PASSWORD https://fluidsurveys.com/api/v3/?format=xml

.. code-block:: xml

    <?xml version="1.0" encoding="utf-8"?>
    <root><surveys>https://fluidsurveys.com/api/v3/surveys/</surveys>
    <collectors>https://fluidsurveys.com/api/v3/collectors/</collectors>
    <contacts>https://fluidsurveys.com/api/v3/contacts/</contacts>
    <embeds>https://fluidsurveys.com/api/v3/embeds/</embeds>
    <contact-lists>https://fluidsurveys.com/api/v3/contact-lists/</contact-lists>
    <webhooks>https://fluidsurveys.com/api/v3/webhooks/</webhooks></root>

When sending `POST` or `PUT` requests pleasure ensure the `Content-Type` header matches
the content in the body of your request.  We accept both `application/json` and `application/x-www-form-urlencoded` as valid `Content-Type` headers.

Surveys Guide
^^^^^^^^^^^^^

Learn how to retrieve, filter, and delete your surveys in the :ref:`survey-guide`.
