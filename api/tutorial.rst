Tutorial
========
This tutorial will be broken into a series of smaller, digestible, mini-pieces which will help guide you step by step through integrating the FluidSurveys API into your application or website.

Introduction
````````````

Over the course of this tutorial we will be building a very simple web app to manage our surveys.  It should be able to:

* view a list of your surveys
* view responses to a survey
* take you to the survey to fill out
* create an invite to a survey
* add contacts to the invitation and send it

The app will be hosted on our own domain.  Because of security concerns and limitations in the browser we cannot easily query the FluidSurveys API from a web app.  Instead, we will create a proxy on our own domain that our web app will be able talk to.  This proxy will relay all requests to and from the API to our web app.  We will be writing the proxy in PHP but you can choose whichever language you are most familiar with.  Let us know what you create and we can showcase it in our demo section.

Before You Start
````````````````

You should be comfortable with the following before you begin:

* having your own hosting solution (that can run PHP or your language of choice)
* knowledge of HTML5/CSS
* strong knowledge of Javascript and jQuery
* A FluidSurveys account and API key

It would be nice if we could use our web app while we are mobile, so in Part III we will also be using jQueryMobile to enhance our web app.  Make sure you keep the `jQuery Mobile Docs <http://jquerymobile.com/demos/1.0.1/>`_ handy for reference too.

**DISCLAIMER:**
	This tutorial is only meant to be a simple example to show you how to send and retrieve data from the FluidSurveys API.  We sacrifice everything but the bare essentials to show how to interact with the API in the simplest form.  If you are using the API in a production app please be sure to secure, validate, and follow best practices.

Part I: GET the Basics
``````````````````````

In :ref:`tutorial-one` - we set up a proxy to GET surveys and responses from the FluidSurveys API.

Part II: POST-IT
````````````````

In :ref:`tutorial-two` - we get our contact lists, create an email and send it to a contact list!


