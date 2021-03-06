Invites and Email API
=====================

The invites API allows you to create and modify contacts, generate invitation codes, and
send emails using the FluidSurveys email system.

Contacts
--------

Each user in FluidSurveys has his/her own address book, containing a number of contacts.
Contacts can be arranged into contact lists, which are displayed in the invite tool and
make it easier to send invitations to pre-specified groups of contacts. Contacts have a
name, email address, and any number of custom fields.

Any method that returns contacts also accepts two optional query parameters: `survey` and
`collector`. Only one of the two parameters can be used, and must be the identifier of a
survey (resp. collector) owned by the user. Including the parameter will add an additional
`status` field to each contact.

Getting a list of contacts
``````````````````````````

.. http:get:: /api/v3/contacts/

    Returns a list of contacts in the user's address book. The response contains a
    key called `custom` which has a list of all custom fields in the user's address book.

    :query offset: response pagination offset (defaults to 0).
    :query limit: maximum number of results to return (defaults to 10).
    :query search: search terms to filter contacts.

    Sample response::

      {
        "custom": ["field1"],
        "contacts": [{
	  "id": 1,
	  "uri": "http://fluidsurveys.com/api/v3/contacts/1/",
	  "name": "Peter Griffin",
	  "email": "peter.griffin@example.com",
	  "unsubscribed": false,
	  "custom_field1": "field1"
	}, {
	  "id": 2,
	  "uri": "http://fluidsurveys.com/api/v3/contacts/2/",
	  "name": "Joe Swanson",
	  "email": "joe.swanson@example.com",
	  "unsubscribed": false
	}],
	"start": 0,
	"total": 2
      }

Creating a contact
``````````````````

.. http:post:: /api/v3/contacts/

    Creates a new contact. Contact must be sent as an :mimetype:`application/json`-encoded
    dictionary with the required fields ``name`` and ``email``. Custom fields may be specified
    as ``custom_[name]``.

    Sample response::

      {
        "contact": {
          "id": 15136498,
	  "uri": "http://fluidsurveys.com/api/v3/contacts/15136498/",
          "name": "Dave Jones",
          "email": "dave.jones@example.com",
          "unsubscribed": false
        }
      }

Getting contact details
```````````````````````

.. http:get:: /api/v3/contacts/:id/

    Returns details for a contact.

    Sample response::

      {
        "contact": {
          "id": 15136498,
	  "uri": "http://fluidsurveys.com/api/v3/contacts/15136498/",
          "name": "Dave Jones",
          "email": "dave.jones@example.com",
          "unsubscribed": false
        }
      }

Deleting a contact
``````````````````

.. http:delete:: /api/v3/contacts/:id/

    Deletes the specified contact.

Contact's Invites
-----------------

Managing a Contact's invites across multiple surveys can be problematic, so we provide an easy way to retrieve & view the status of the invites.

Finding a Contact
`````````````````

.. http:get:: /api/v3/contacts/?search=:email&invites

  :query search: Email address of the Contact
  :query invites: This will trigger a redirect, including the "invites" filter

If you do not know the Contact's ID, you can search by email address and specify "invites" in the query string, which will redirect you to the Contact's details

Contact's Invites
`````````````````

.. http:get:: /api/v3/contacts/:id/?invites

  :query invites: Includes an array of survey invites

By adding "?invites" to the Contact's details URI, you'll receive an extra "invites" Array with the status of the invites

.. code-block:: json

  {
    "name": "New Guy", 
    "email": "newguy@example.com", 
    "id": 8003316, 
    "contact_uri": "https://fluidsurveys.com/api/v3/contacts/8003316/", 
    "unsubscribed": [], 
    "invites": [
        {
            "status": "Viewed", 
            "survey_uri": "https://fluidsurveys.com/api/v3/surveys/325235/", 
            "invite_uri": "https://fluidsurveys.com/surveys/myaccount/mysurvey/?hash=cqxnq9v8zw"
        }
    ]
  }

Contact Lists
-------------

Contact lists allow grouping contacts into manageable lists based on different criteria.
Managing the contacts within a list is done using the list's contact view.

Getting contact lists
`````````````````````

.. http:get:: /api/v3/contact-lists/

    Returns a list of the user's contact lists.

    :query offset: response pagination offset (defaults to 0).
    :query limit: maximum number of results to return (defaults to 10).

    Sample response::

      {
        "lists": [{
          "id": 1,
	  "uri": "http://fluidsurveys.com/api/v3/contact-lists/1/",
	  "contacts_uri": "http://fluidsurveys.com/api/v3/contact-lists/1/contacts/",
          "name": "People with Silly Walks",
          "contacts": 10
        }],
	"total": 1
      }

Creating a contact list
```````````````````````

.. http:post:: /api/v3/contact-lists/

    Creates a new contact list. Data must be sent as an :mimetype:`application/json`-encoded
    dictionary with the required field ``name``.

Getting contact list details
````````````````````````````

.. http:get:: /api/v3/contact-lists/:id/

    Returns details for a contact list.

    Sample response::

      {
        "list": {
          "id": 1,
	  "uri": "http://fluidsurveys.com/api/v3/contact-lists/1/",
	  "contacts_uri": "http://fluidsurveys.com/api/v3/contact-lists/1/contacts/",
          "name": "People with Silly Walks",
          "contacts": 10
        }
      }

Getting contacts
````````````````

.. http:get:: /api/v3/contact-lists/:id/contacts/

    Returns the contacts that are part of the given contact list. This method takes the
    same arguments as :http:get:`/api/v3/contacts/ </api/v3/contacts/>`.

Adding contacts
```````````````

.. http:post:: /api/v3/contact-lists/:id/contacts/

    Adds contacts to a contact list. There are three ways to add contacts:

    1. A POST parameter ``contact_list`` containing the identifier of a contact list to
       add.

    2. :mimetype:`multipart/form-data`-encoded data containing the key ``contacts`` with
       a list of identifiers of contacts to add.

    3. Use the same parameters as for :http:post:`/api/v3/contacts/ <creating contacts>`,
       which will create the contact and add it directly to the list.

Removing contacts
`````````````````

.. http:delete:: /api/v3/contact-lists/:id/contacts/

    Removes contacts from the specified contact list.


Invite Codes
------------

In order to deploy your surveys in a trackable manner, you can use invite codes. While the 
recommended method to deploy your surveys using invite codes is by creating contacts in your
FluidSurveys address book (see above) and send an email to them (see below) which will auto-
populate codes, we also allow you to generate invite codes for use with other systems.

For the methods below, an optional parameter `collector` may be used, which must be the 
id of a survey collector. If not provided, the default collector is assumed.

Generating a list of invite codes
`````````````````````````````````

.. http:post:: /api/v3/surveys/:survey_id/invite-codes/

    Generates invite codes for use with the survey/collector specified.
    
    :query collector: (optional) ID of the collector for which to generate invites.
    :query count: The number (between 1 and 1000) of invite codes to generate

    Sample response::

	{
	  "count": 1,
	  "invites": [
	    {
	      "code": "XXXXXXXX",
	      "invite_url": "http://fluidsurveys.com/s/somesurvey/?code=XXXXXXXX"
	    }
	  ]
	}

Retrieving generated invite codes
`````````````````````````````````

.. http:get:: /api/v3/surveys/:survey_id/invite-codes/

    Returns a list of generated invite codes for the survey/collector specified. 
    Pagination is supported through the `offset` and `limit` query parameters. 

    :query offset: response pagination offset (defaults to 0).
    :query limit: maximum number of results to return (defaults to 50 max is 200).
    :query collector: (optional) ID of the collector for which to generate invites.

    Sample response::

	{
	  "count": 2,
	  "start": 0,
	  "total": 2,
	  "invites": [
	    {
	      "status": "Viewed",
	      "code": "XXXXXXXX",
	      "invite_url": "http://fluidsurveys.com/s/somesurvey/?code=XXXXXXXX"
	    },
	    {
	      "status": "Completed",
	      "code": "YYYYYYYY",
	      "response_id": "XXXXX",
	      "response_uri": "http://fluidsurveys.com/api/v3/surveys/:survey_id/responses/XXXXX/",
	      "invite_url": "http://fluidsurveys.com/s/somesurvey/?code=YYYYYYYY"
	    }
	  ]
	}

Example
-------

    Let's write a quick python script to create a contact and add them to an email:

Set up
``````

	We will be using the **requests** module to easily handle the details of HTTP requests. You can find out more about it at http://docs.python-requests.org. ::
	
		import requests, json
		
	We are also using the built in **json** module to send and receive all the json data we will be working with.  We will also need your API key (which you can find on your FluidSurveys settings page) and your password. ::
	
		API_KEY = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
		PASSWORD = 'password'
		
	We'll also save the base URI and Headers in some variables: ::

		headers = {"Content-Type": "application/json"}
		URI = 'https://fluidsurveys.com/api/v3/'
		
Create a Contact
````````````````
	To create a contact all we need is a *name* and *e-mail*::
	
		payload = {"name":"John Doe", "email":"johndoe@gmail.com"}
		r = requests.post(URI+'contacts/', data=json.dumps(payload), 
			headers=headers, auth=(api_key, password))
		result = json.loads(r.content)
		contact_id = result['contact']['id']
		
	Here we set the data we are going to attach to our POST request in the variable *payload*.  We use the **requests** module's *post* method with our headers, authentication details and our payload formatted as json.
	
	Note that you will get an error message if you try and add a contact that already exists.  We are **not** doing any error checking for the purposes of this example but of course, you always **should**.
	
Get our Surveys
```````````````

	A quick ``GET`` to ``/surveys/`` will return all our surveys.  We are just taking the first one here, but you can filter them however you would like::
	
		r = requests.get(URI+'surveys/',auth=(api_key,password))
		result = json.loads(r.content)
		survey_id = result['surveys'][0]['id']
		
Create an Email
```````````````

	Your email request must include a *subject*, *sender*, and *message*.  The *message* must include the string *[Invite Link]* and the sender must be formatted as ``'Name <email@domain.com>'``::

		payload = {"subject":"Hello",
			"message":"Hi, [Full Name], check out our survey: [Invite Link]!",
			"sender":"Me <me@example.com>"
			}
		r = requests.post(URI+'emails/?survey=%d' % (survey_id,), 
			data=json.dumps(payload), 
			headers=headers, auth=(api_key,password))
		result = json.loads(r.content)
		send_uri = result['send_uri']
		email_id = result['id']
		recipients_uri = result['recipients_uri']
		
	The response returns uris for adding recipients and sending the email which we will use to finish our script.


Add Contact to Email
````````````````````

	We do not need to send a single contact as json, we can simply ``POST``::

		r = requests.post(recipients_uri, data='contacts=%d' % (contact_id,),
		 	auth=(api_key,password))
		
Send Email
``````````

	Sending the email is just as easy, just *POST* to the send_uri we got when we created the email::
	
		r = requests.post(send_uri, headers={"Content-Length": '0'}, 
			auth=(api_key,password))
		
	Note we have to specifiy ``Content-Length = 0`` in the headers when were are POSTing no data.  If everything went as planned you should get a response similar to::
	
		{
			u'status': u'scheduled',
			u'scheduled': u'2012-01-26T22:51:29Z',
			u'sender': u'Me <me@example.com>',
			u'footer': None,
			u'created_at': u'2012-01-26T22:46:28Z',
			u'num_recipients': 1,
			u'updated_at': u'2012-01-26T22:46:28Z',
			u'message': u'Hi, [Full Name], check out our survey: [Invite Link]!',
			u'id': 25206,
			u'subject': u'Hello'
		}

Scheduling Invites
``````````````````

    In order to schedule invites some time in the future, you may append a `scheduled` variable to the end of the `send_uri`.

    i.e., ``send_uri + '?scheduled=7'`` will schedule your invite 7 days from now.  You can specify the number of weeks, days, hours, and minutes by suffixing a number with the letters ``w, d, h,`` and ``m`` respectively:
    
    For example, appending ``'?scheduled=1w3d4h2m'`` to the `send_uri` will schedule your invite to send 1 week, 3 days, 4 hours, and 2 minutes from the time you submit your request.
