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
	
Create a User
`````````````

You can create a new user account and set their username, email, and password with the following

.. http:post:: /api/v2/users/

    :form email: email address of the user to create
    :form password: if omitted the default password will be set to `abc123`
    :form username: an optional username for the user

     Sample response: ::

	{
	  "username": "bob",
	  "plan": "http://myaccount.fluidsurveys.com/api/v2/plan/enterprise/",
	  "id": 6,
	  "plan_name": "enterprise",
	  "uri": "http://myaccount.fluidsurveys.com/api/v2/user/6/",
	  "resources": {},
	  "email": "bob@example.com"
	}


Groups
======

Using the FluidSurveys API you can administer the different groups on your account.  Including creating groups, adding users
with specific roles, and adding surveys to groups.

Create a Group
``````````````

.. http:post:: /api/v2/groups/

	The only required parameter to create a group is `name` - alphanumeric characters only please! 

List all Groups
```````````````

.. http:get:: /api/v2/groups/



     Sample response: ::

	{
	    "count": 1,
	    "groups": [
	        {
	            "group_uri": "http://fluidsurveys.com/api/v2/groups/1/",
	            "num_members": 3,
	            "id": 1,
	            "name": "Group A"
	        }
	    ]
	}


Group Details
`````````````

	Follow the group_uri to get more detailed information on the group or modify it:
	
.. http:get:: /api/v2/groups/:id/

    Sample response: ::

	{
	    "surveys": [],
	    "num_members": 2,
	    "name": "New Group",
	    "polls": [],
	    "group_uri": "http://fluidsurveys.com/api/v2/groups/11/",
	    "members": [
	        {
	            "id": 2,
	            "user_uri": "http://fluidsurveys.com/api/v2/users/2/",
	            "name": "Bob",
	            "roles": [
	                "Edit",
	                "Test",
	                "Publish",
	                "Deploy",
	                "Analyze"
	            ],
	            "email": "mike+bob@example.com"
	        }
	    ],
	    "id": 11
	}
	
Rename Group
````````````

.. http:put:: /api/v2/accounts/groups/:id/

	Like creating a group, the only parameter currently available is `name`

    Sample response: ::

	{
	    "group_uri": "http://fluidsurveys.com/api/v2/groups/11/",
	    "num_members": 2,
	    "id": 11,
	    "name": "New Name"
	}
	
Delete Group
````````````

.. http:delete:: /api/v2/accounts/groups/:id/

    Sample response: ::

	{
		"success": true
	}

Group Members
`````````````

.. http:get:: /api/v2/accounts/groups/:id/members/

	View the list of members in the group.

    Sample response: ::

	{
	    "num_members": 3,
	    "members": [
	        {
	            "id": 2,
	            "user_uri": "http://fluidsurveys.com/api/v2/users/2/",
	            "name": "Bob",
	            "roles": [
	                "Edit",
	                "Test",
	                "Publish",
	                "Deploy",
	                "Analyze"
	            ],
	            "email": "mike+bob@example.com"
	        },
	        {
	            "id": 8,
	            "user_uri": "http://fluidsurveys.com/api/v2/users/8/",
	            "name": "Apple",
	            "roles": [
	                "Deploy",
	                "Analyze"
	            ],
	            "email": "mike+apple@example.com"
	        },
	        {
	            "id": 3,
	            "user_uri": "http://fluidsurveys.com/api/v2/users/3/",
	            "name": "",
	            "roles": [
	                "Edit",
	                "Test",
	                "Publish",
	                "Deploy"
	            ],
	            "email": "mike+mike@example.com"
	        }
	    ]
	}
	

Add a Member
````````````

To add a member of your account to a group:

.. http:put:: /api/v2/accounts/groups/:id/members/

    :form email: email address of the user to add
    :form roles: space separated group roles to assign the user, e.g. `edit deploy analyze test publish`

    Sample response: ::

	{
	    "user_uri": "http://fluidsurveys.com/api/v2/users/7/",
	    "group": {
	        "group_uri": "http://fluidsurveys.com/api/v2/groups/1/",
	        "num_members": 4,
	        "id": 1,
	        "name": "Group A"
	    },
	    "name": "Jim",
	    "roles": [],
	    "id": 7,
	    "email": "mike+jim@example.com"
	}
	
Member Roles
````````````

	To grant or revoke roles to a group member, send the same `PUT` request with updated roles.
	
.. http:put:: /api/v2/accounts/groups/:id/members/

    :form email: email address of the user to add
    :form roles: space separated group roles to assign the user, e.g. `edit deploy analyze test publish`

    Sample responses: ::

	{
	    "user_uri": "http://fluidsurveys.com/api/v2/users/7/",
	    "group": {
	        "group_uri": "http://fluidsurveys.com/api/v2/groups/1/",
	        "num_members": 4,
	        "id": 1,
	        "name": "Group A"
	    },
	    "name": "",
	    "roles": [
	        "Edit",
	        "Deploy"
	    ],
	    "id": 7,
	    "email": "mike+jim@example.com"
	}
	
Remove Member
`````````````

    Send a `DELETE` request with an `email` parameter to remove a member from a group.

.. http:delete:: /api/v2/accounts/groups/:id/members/

    :form email: email address of the user you wish to remove


    Sample responses: ::

	{
	    "success": true
	}

	
Add Group to Survey
```````````````````

To use groups effectively you need to assign them to surveys.  To add a group to a survey:

.. http:put:: /api/v2/surveys/:id/groups/

    :form group: a space delimited list of group ids

    Sample responses: ::

	{
	    "success": true
	}
	

Removing Group from Survey
``````````````````````````

To remove a group from a survey:

.. http:delete:: /api/v2/surveys/:id/groups/

    :form group: group id of the group to be removed from the survey
	
    Sample responses: ::

	{
	    "success": true
	}









