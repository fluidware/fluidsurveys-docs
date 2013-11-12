.. _contacts-guide:

Managing Contacts
=================

In this section of our API guidebook we take a look at managing contacts.  You can create,
   edit,
   and delete individual contacts as well as contact lists that group a set of contacts.

Create a Contact
----------------

.. http:post:: /api/v3/contacts/

  *(\* denotes required parameters)*

  :form name*: the name of the contact
  :form email*: email address of the contact

::

  curl -u bob@example.com:PASSWORD -d "name=new guy&email=newguy@example.com" \
  https://fluidsurveys.com/api/v3/contacts/

.. code-block:: json

  {"id": 8003316,
   "contact_uri": "https://fluidsurveys.com/api/v3/contacts/8003316/",
   "email": "newguy@example.com",
   "name": "new guy",
   "unsubscribed": false}

Edit a Contact
--------------

.. http:put:: /api/v3/contacts/:id/

  :form name: updated name
  :form email: updated email

::

  curl -u bob@example.com:PASSWORD -X PUT -d "name=New Guy" \
  https://fluidsurveys.com/api/v3/contacts/8003316/

.. code-block:: json

  {"id": 8003316,
   "contact_uri": "https://fluidsurveys.com/api/v3/contacts/8003316/",
   "email": "newguy@example.com",
   "name": "New Guy",
   "unsubscribed": false}


Finding Contacts
----------------

.. http:get:: /api/v3/contacts/

  :query search: optional keyword to search for

Return a list of all contacts, optionally filtered by the `search` query parameter.

::

  curl -u bob@example.com:PASSWORD \
  https://fluidsurveys.com/api/v3/contacts/?search=example.com

.. code-block:: json

  {"count": 1,
   "next": null,
   "previous": null,
   "results": [
     {"name": "New Guy",
      "email": "newguy@example.com",
      "id": 8003316,
      "contact_uri": "https://fluidsurveys.com/api/v3/contacts/8003316/",
      "unsubscribed": false
     }
    ]
  }

Delete a Contact
----------------

.. http:delete:: /api/v3/contacts/:id/

::

  curl -u bob@example.com:PASSWORD -X DELETE \
  https://fluidsurveys.com/api/v3/contacts/8003316/

.. code-block:: json

  "OK"

