Welcome to FluidSurvey Dev!
==========================
.. note::
	To access product documentation, please visit  `Fluidsurvey Help <http://help.fluidsurveys.com/hc/en-us>`_.

Getting Started
---------------
If you're new to Fluidsurveys API, you may want to start with these documents to get
you up and running:

Request Limits
^^^^^^^^^^

 * Free - 100 requests / day
 * Pro & Ultra - 1000 requests / day
 * Enterprise - 10000 requests / day
 
The maximum burst rate is 60 requests / minute across all plan types.
 
If you run into any of the above limits, FluidSurveys will return the following error:

::

    HTTP 429

with a message informing you of the amount of time it will take for the next request to go through.


API v2 Documentation
^^^^^^^^^^

Version 2 of the survey is being deprecated and is no longer under active development.
We will continue to support and fix any reported issues.  See :ref:`version-three` for the latest
developments of our new API.

Many of the features provided by FluidSurveys are also accessible through a web-based API.

.. toctree::
	:maxdepth: 2

	fluidsurveys/api/authentication
	fluidsurveys/api/accounts
	fluidsurveys/api/surveys
	fluidsurveys/api/invites
	fluidsurveys/api/webhooks

Check out the `preview of the new v3 API <https://fluidsurveys.com/api/v3/>`_!

.. _version-three:

API v3 Documentation
--------------------

New! Preview of our newest version of the API.  (*Work in progress*)


.. toctree::
    :maxdepth: 2

    fluidsurveys/apiv3/index
    fluidsurveys/apiv3/oauth
    fluidsurveys/apiv3/surveys
    fluidsurveys/apiv3/responses
    fluidsurveys/apiv3/invites
    fluidsurveys/apiv3/contacts

