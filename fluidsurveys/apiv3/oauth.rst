.. _auth-guide:

OAuth
=====

OAuth2 allows external apps access to FluidSurveys users data without requiring their password.  This allows users to limit the access of externals apps and revoke access to external apps though FluidSurveys.

Registering
-----------

If you would like to request authorization from FluidSurveys users you must first reigster your application on the `developer page <https://fluidsurveys.com/accounts/developer/>`_ and provide your:

*   application name
*   homepage url
*   callback url
*   description

You will recieve a `client_id` and `secret`.  Keep this safe!  We recommend storing these as environment variables.

Authentication Flow
-------------------

Follow the following steps to complete the authorization flow:

1. Redirect to FluidSurveys
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Create a link on your site to ask the user to authorize your application.

.. http:get:: https://fluidsurveys.com/accounts/developer/authorize/

  :query response_type: this should be `code`
  :query client_id: your `client_id`
  :query redirect_uri: your `redirect_uri`

2. FluidSurveys redirects back your application
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Once the user has authorized your application, they will be redirected back to your `redirect_uri`.  Included in the request will be a `code` query parameter.  You may then trade this `code` for an access token in the next step.

3. Obtain Bearer Token
^^^^^^^^^^^^^^^^^^^^^^

.. http:post:: https://fluidsurveys.com/accounts/oauth/token/

   :form code: the `code` you recieved from the redirect
   :form client_id: your `client_id`
   :form client_secret: your `client_secret`
   :form redirect_uri: your `redirect_uri`
   :form grant_type: should be `authorization_code`

::

  curl -u bob@example.com:PASSWORD -d "code=12345&client_id=demo&client_secret=SECRET
  &redirect_uri=http://www.example.com/fluid/&grant_type=authorization_code" \ 
  https://fluidsurveys.com/accounts/oauth/token/

.. code-block:: json

    {
      "access_token": "DCFUHW92F3HF2E2F2F20H"
    }

4. Making Requests
^^^^^^^^^^^^^^^^^^

You can now make API requests on behalf of the user.  Set the `Authorization` header to include the access token.

::

    curl --header "Authorization: Bearer DCFUHW92F3HF2E2F2F20H" \
    https://fluidsurveys.com/api/v3/

.. code-block:: json

    {"templates": "http://fluidsurveys.dev:8000/api/v3/templates/",
     "surveys": "http://fluidsurveys.dev:8000/api/v3/surveys/",
     "collectors": "http://fluidsurveys.dev:8000/api/v3/collectors/",
     "contacts": "http://fluidsurveys.dev:8000/api/v3/contacts/",
     "embeds": "http://fluidsurveys.dev:8000/api/v3/embeds/",
     "contact-lists": "http://fluidsurveys.dev:8000/api/v3/contact-lists/",
     "webhooks": "http://fluidsurveys.dev:8000/api/v3/webhooks/"
    }










