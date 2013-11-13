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

Return a list of all contacts,
   optionally filtered by the `search` query parameter.

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

Creating Lists
--------------

.. http:post:: /api/v3/contact-lists/

  :form name: name of contact list
  :form color: hexadecimal color code

::

  curl -u bob@example.com:PASSWORD -d "name=Employees" \
  https://fluidsurveys.com/api/v3/contact-lists/

.. code-block:: json

  {"color": "#9eb7c8",
   "contacts_uri": "https://fluidsurveys.com/api/v3/contact-lists/96920/contacts/",
   "id": 96920,
   "name": "Employees",
   "contacts": 0
  }

Adding a Contact to a List
--------------------------

Use an existing contact's `id` to add it to a contact list, or create a new contact while adding it to a list by specifying the `name` and `email`. 

.. http:post:: /api/v3/contact-lists/:id/contacts/
  
  :form id: a comma seperated list of contact ids
  :form name: name of new contact
  :form email: email of new contact
  
::

  curl -u bob@example.com:PASSWORD -d "name=Brand New&email=brandnew@example.com" \
  https://fluidsurveys.com/api/v3/contact-lists/96920/contacts/
  
.. code-block:: json

  {"count": 1,
   "next": null,
   "previous": null,
   "results": [{"id": 1,
   "name": "Bob",
   "email": "bob@example.com"}]
  }

     

