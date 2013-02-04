Accounts API
============

The REST API is accessed through HTTPS with Basic authentication using the user's API key
and password.

Note that for these APIs, you must have a developer API key. In order to obtain one, you
must contact support or your account administrator.

Generating a one-time login URL for a user
``````````````````````````````````````````

.. http:post:: /api/v2/accounts/generate-login-url/

    Creates a unique login url that can be used once. Once you've obtained the one-time-login
    url for a particular user, you may redirect that user to the provided url, which will then
    automatically log them in and redirect them to their account page. Once the login url has
    been used once, it is invalidated and may not be used again. You must provide either the
    `username` field, or the `email` field to identify the user account you wish to generate
    the login url for.

    :form key: The developer API key
    :form username: The username of the user account you wish to generate the login for.
    :form email: The email address of the account you wish to generate the login for.
    :form password: The password of the user account you wish to generate the login for.
    
    Sample successful response: ::

	{
	  "success": true,
	  "user_id": XXXXX,
	  "username": "someuser",
	  "email": "someuser@somedomain.com",
	  "login-url": "http://fluidsurveys.com/accounts/login/?key=XXXXXXXXXXXXXXXXXXXXX"
	}

    Sample error response: ::

	{
	  "success": false,
	  "code": "not_authorized",
	  "description": "Must specify a valid 'password' parameter for the specified user.",
	}

