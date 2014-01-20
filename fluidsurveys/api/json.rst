.. _survey-json:

Survey JSON
===========

**This document is still in development and subject to change.**

FluidSurveys are represented by using the common JSON format.  This document attempts to describe the structure of
a valid survey.  Make sure you are comfortable with JSON before you attempt to make your own surveys with it!

To create a survey with your own JSON send a *POST* request to:

.. http:post:: /api/v2/surveys/

**Make sure** you set the `Content-Type` header to `application/json` and the body of your `POST` request is a valid JavaScript object.

We will explore the structure of that JavaScript object which describes your survey for the remainder of this document.


An Empty Survey
```````````````

The minimum required JSON for a valid empty survey is as follows:

.. code-block:: javascript

	{
		"title": "My New Survey"
	}

If you've sent a valid `POST` request you will get a response like:

.. code-block:: javascript

	{
	    "name": "My New Survey",
	    "uri": "http://fluidsurveys.com/api/v2/surveys/12345/",
	    "deploy_uri": "http://fluidsurveys.com/surveys/bob/new-survey-4/",
	    "report_url": "http://fluidsurveys.com/account/surveys/12345/reports/",
	    "responses_url": "http://fluidsurveys.com/account/surveys/12345/responses/",
	    "id": 12345,
	    "edit_url": "http://fluidsurveys.com/account/surveys/12345/edit/"
	}

If you visit the `deploy_uri` you will your survey ready to be taken.  But wait...
	
	The survey you are trying to take is either not live or not available to you.

Our survey can't yet be taken - because we didn't specify any questions!

Adding Questions
````````````````

Section Separator
#################

In order to add question to our survey we have to create a `form` property on our JSON object.  The `form` will contain all the details of the survey questions.  The form must be an **array**.  In this array, we will put objects representing *pages*.  Each `page` object contains a property called `children` which is another **array** of question **objects**.

This is getting complicated fast, let's look at an example:

.. code-block:: javascript

	{
        "title": "My New Survey",
        "form": [
            {
                "children": [{
                    "idname": "section-separator",
                    "title": "Hello world"
                }]
            }
          ]
	}

Take notice of the following:

* `form` has been added as a top-level property
* `form` is an **array** of **objects**
* each of these objects represents a page and has a property called `children` which is another **array**
* each page's `children` array contains a list of **objects** which represent *questions*
* the question object contains the properties `idname` and `title`

`title` as you might suspect, sets the text of question's title.  `idname` is a bit strange however.  It represents the *type* of question.
In this example we have a simple *section separator* which is basically just a paragraph of text on your survey.

Visit the `deploy_uri` and you should see your survey complete with "Hello World" text and a submit button.

Now how about adding some actual questions that users can take on your survey.  Let's take a look at a few question objects.

Text Response
#############

.. code-block:: javascript

	{
	    "title": "What is your name?",
	    "idname": "text-response",
	    "children": [{
	    "type": "string"
	    }],
	   "id": "120394"
	}

Here we have an object representing a text response question.  As you can see the `idname` is now set to `text-response` and we have a few other new properties.  Every question requires a response needs an `id`.  Each question **must** have a unique id.  Also notice the `children` property.  Question objects can have their own children and this is where you can find various options and choices.  It is an **array**.  Here we need to set the `type` to `string`.


Multiple Choice
###############

.. code-block:: javascript

	{
	    "title": "What is your gender?",
	    "idname": "single-choice",
	    "id": "123456",
	    "children": [
	      {
	        "type": "single",
	        "choices": [
	          {
	            "label": "Male"
	          },
	          {
	            "label":  "Female"
	          }
	        ]
	      }
	    ]
	}
	
Note the `idname` of `single-choice`.  For choice questions, you add the `choices` property to the objects in the `children` array.  `choices` itself is an **array** and contains **objects** for each choice.  Each choice has a `label` property that defines the text to be displayed beside the choice.

Checkbox
########

.. code-block:: javascript

	{
	    "title": "Which foods do you enjoy?",
	    "idname": "multiple-choice",
	    "id": "1234567",
	    "children": [
	      {
	        "type": "multiple",
	        "choices": [
	          {
	            "label": "Indian Food"
	          },
	          {
	            "label":  "Chinese Food"
	          }
	        ]
	      }
	    ]
	}
	
Note the `idname` for checkbox questions is `multiple-choice` (and a *multiple choice question* is **single-choice**) and the `type` is `multiple`.  You can add as many choice objects as you want (within reason, try not to go over 30?)

Advanced Details
################

If you want to examine a current survey to see how it's made just send a `GET` request to:

.. http:get:: /api/v2/surveys/:id/?structure

This will return the raw JSON.  You can explore for your self and see how the survey is structured.

Putting it all Together
```````````````````````

Here is the complete JSON for a simple survey with a header, text field, multiple choice question, and a few other options.  Note that all our text strings are contained inside language objects.  This isn't strictly necessary if you're only operating in one language (defaults to English).

.. code-block:: javascript

	{
	  "uniques": [],
	  "firstPageTitleDescription": false,
	  "languageDisplayStyle": "dropdown",
	  "description": {
	    "en": ""
	  },
	  "form": [
	    {
	      "type": "page",
	      "children": [
	        {
	          "description": {
	            "en": ""
	          },
	          "title": {
	            "en": "Hello World"
	          },
	          "idname": "section-separator",
	          "children": [],
	          "width": 100,
	          "type": "question",
	          "id": "7fLwGqpTV6"
	        },
	        {
	          "description": {
	            "en": "*required question"
	          },
	          "title": {
	            "en": "What is your name?"
	          },
	          "idname": "text-response",
	          "children": [
	            {
	              "required": true,
	              "type": "string"
	            }
	          ],
	          "width": 100,
	          "type": "question",
	          "id": "TVU4V2XMPM"
	        },
	        {
	          "description": {
	            "en": ""
	          },
	          "title": {
	            "en": "Your gender?"
	          },
	          "idname": "single-choice",
	          "children": [
	            {
	              "type": "single",
	              "required": false,
	              "randomize": true,
	              "choices": [
	                {
	                  "label": {
	                    "en": "Male"
	                  }
	                },
	                {
	                  "label": {
	                    "en": "Female"
	                  }
	                }
	              ]
	            }
	          ],
	          "width": 100,
	          "type": "question",
	          "id": "dkKPosuDGy"
	        }
	      ]
	    }
	  ],
	  "title": {
	    "en": "My New Survey"
	  },
	  "quotas": [],
	  "languages": [
	    {
	      "code": "en",
	      "name": "English",
	      "isDefault": true
	    }
	  ],
	  "jumping": false,
	  "showBranchingInfo": false
	}

