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

.. http:get:: /api/v2/contacts/

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
	  "uri": "http://app.fluidsurveys.com/api/v2/contacts/1/",
	  "name": "Peter Griffin",
	  "email": "peter.griffin@example.com",
	  "unsubscribed": false,
	  "custom_field1": "field1"
	}, {
	  "id": 2,
	  "uri": "http://app.fluidsurveys.com/api/v2/contacts/2/",
	  "name": "Joe Swanson",
	  "email": "joe.swanson@example.com",
	  "unsubscribed": false
	}],
	"start": 0,
	"total": 2
      }

Creating a contact
``````````````````

.. http:post:: /api/v2/contacts/

    Creates a new contact. Contact must be sent as an :mimetype:`application/json`-encoded
    dictionary with the required fields ``name`` and ``email``. Custom fields may be specified
    as ``custom_[name]``.

    Sample response::

      {
        "contact": {
          "id": 15136498,
	  "uri": "http://app.fluidsurveys.com/api/v2/contacts/15136498/",
          "name": "Dave Jones",
          "email": "dave.jones@example.com",
          "unsubscribed": false
        }
      }

Getting contact details
```````````````````````

.. http:get:: /api/v2/contacts/:id/

    Returns details for a contact.

    Sample response::

      {
        "contact": {
          "id": 15136498,
	  "uri": "http://app.fluidsurveys.com/api/v2/contacts/15136498/",
          "name": "Dave Jones",
          "email": "dave.jones@example.com",
          "unsubscribed": false
        }
      }

Deleting a contact
``````````````````

.. http:delete:: /api/v2/contacts/:id/

    Deletes the specified contact.

Contact Lists
-------------

Contact lists allow grouping contacts into manageable lists based on different criteria.
Managing the contacts within a list is done using the list's contact view.

Getting contact lists
`````````````````````

.. http:get:: /api/v2/contact-lists/

    Returns a list of the user's contact lists.

    :query offset: response pagination offset (defaults to 0).
    :query limit: maximum number of results to return (defaults to 10).

    Sample response::

      {
        "lists": [{
          "id": 1,
	  "uri": "http://app.fluidsurveys.com/api/v2/contact-lists/1/",
	  "contacts_uri": "http://app.fluidsurveys.com/api/v2/contact-lists/1/contacts/",
          "name": "People with Silly Walks",
          "contacts": 10
        }],
	"total": 1
      }

Creating a contact list
```````````````````````

.. http:post:: /api/v2/contact-lists/

    Creates a new contact list. Data must be sent as an :mimetype:`application/json`-encoded
    dictionary with the required field ``name``.

Getting contact list details
````````````````````````````

.. http:get:: /api/v2/contact-lists/:id/

    Returns details for a contact list.

    Sample response::

      {
        "list": {
          "id": 1,
	  "uri": "http://app.fluidsurveys.com/api/v2/contact-lists/1/",
	  "contacts_uri": "http://app.fluidsurveys.com/api/v2/contact-lists/1/contacts/",
          "name": "People with Silly Walks",
          "contacts": 10
        }
      }

Getting contacts
````````````````

.. http:get:: /api/v2/contact-lists/:id/contacts/

    Returns the contacts that are part of the given contact list. This method takes the
    same arguments as :http:get:`/api/v2/contacts/ </api/v2/contacts/>`.

Adding contacts
```````````````

.. http:post:: /api/v2/contact-lists/:id/contacts/

    Adds contacts to a contact list. There are three ways to add contacts:

    1. A POST parameter ``contact_list`` containing the identifier of a contact list to
       add.

    2. :mimetype:`multipart/form-data`-encoded data containing the key ``contacts`` with
       a list of identifiers of contacts to add.

    3. Use the same parameters as for :http:post:`/api/v2/contacts/ <creating contacts>`,
       which will create the contact and add it directly to the list.

Removing contacts
`````````````````

.. http:delete:: /api/v2/contact-lists/:id/contacts/

    Removes contacts from the specified contact list.

Emails
------

FluidSurveys allows sending scheduled emails to contacts through the API. Once an email
is created, its recipients can be changed using the recipients API endpoint. Each contact
will only receive a single unique invite code per survey. To allow contacts to give
multiple responses to the same survey, you must use different collectors.

Creating a new email
````````````````````

.. http:post:: /api/v2/emails/

    Creates a new email. Data must be sent as an :mimetype:`application/json`-encoded
    dictionary.

    Sample request::

      {
	"subject": "Email subject",
	"message": "Dear [Full Name],\n\nMessage body: [Invite Link]"
      }

Getting email details
`````````````````````

.. http:get:: /api/v2/emails/:id/

    Gets details for an email.

    Sample response::

      {
        "id": 1,
	"status": "sent",
	"sender": "",
	"subject": "Email subject",
	"message": "Dear [Full Name],\n\nMessage body: [Invite Link]",
	"uri": "http://app.fluidsurveys.com/api/v2/emails/1/",
	"send_uri": "http://app.fluidsurveys.com/api/v2/emails/1/send/",
	"recipients_uri": "http://app.fluidsurveys.com/api/v2/emails/1/recipients/",
	"num_recipients": 5
      }

Deleting an email
`````````````````

.. http:delete:: /api/v2/emails/:id/

    Deletes a scheduled email.

Getting recipients
``````````````````

.. http:get:: /api/v2/emails/:id/recipients/

    Returns the contacts that are recipients for the specified email. This method takes
    the same arguments as :http:get:`/api/v2/contacts/ </api/v2/contacts/>`.

Adding recipients
`````````````````

.. http:post:: /api/v2/emails/:id/recipients/

    Adds recipients to an email. This method takes the same arguments as
    :http:post:`/api/v2/contact-lists/:id/contacts/ </api/v2/contact-lists/:id/contacts/>`.

Removing recipients
```````````````````

.. http:delete:: /api/v2/emails/:id/recipients/

    Deletes recipients from an email.
