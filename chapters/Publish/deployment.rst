Deployment
----------

Deployment Status
^^^^^^^^^^^^^^^^^

In order to make survey either accessible, or inaccessible to the public, it must be set to Live or Closed respectively. But, any survey created, by default will have its status set to "Live". "Closed" allows the survey creator to build and test their questionnaire in a private environment. Since all surveys are "Live" by default, the surveys existence will be unknown to anyone, as the Administrator is in control of informing the rest of the world about its being.

.. tip::

	You can also alter the deployment status on your survey by clicking "Live" or "Closed" on your survey in the Survey Dashboard

	.. image:: ../../resources/publish/deployment_status_indicator.png
		:scale: 70%
		:align: center
		:class: screenshot
		:alt: Section Heading

A Closed survey will present the following error message to anybody who tries to load the survey.

.. figure:: ../../resources/publish/closed_survey_message.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Closed Survey Error Message

	*Figure 9.1* Closed Survey Error

When a survey is Live, it is a generally advised against changing anything. However, if a addition or subtraction must be made, please refer to the list below to see if your aim is Acceptable, or an Unacceptable Change

**Acceptable Changes:** These modifications can be made while responses are being, or have been, collected and will not affect the integrity of the data.

* Changing the order of questions (Moving questions around on the page, or between pages)
* Changing the wording of questions
* Add new questions

**Unacceptable Changes**: These modifications cannot be made while responses are being, or have been, collected as they will affect the integrity of the data.

* Deleting questions: Once you delete a question, all of the responses that have been collected for that question will be cleared from the results with no possibility of recovery
* Re-arranging choices in a question: If you change the order of choices in a question, the responses will no longer correctly match up, resulting in data integrity issues. Responses are stored based on the location of the choice, not the name of the choice

Online Deployment URL
^^^^^^^^^^^^^^^^^^^^^

Every survey created within an account is defined by its parts; Username and the name of the survey. The Online Deployment URL is what links the world up with your specific survey.

As a result, a URL will always take the username and the name of the survey into consideration when defining itself. In some cases, this can cause a large link that may look off-setting to some potential respondents. It is possible to shorten the URL to a smaller and more manageable size.  

Click "Customize this URL" beside the Online Deployment URL, enter a desired name, and either "Valid, click Save to confirm..." will appear, or "Already taken, choose another..." if the URL has already been claimed.

.. figure:: ../../resources/publish/customize_this_url.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Customized URL

	*Figure 9.1* Customized URL

Additionally, a feature of FluidSurveys is the ability to present a survey in a number of langauges (72 to be exact!) which allows for a survey to be deployed in those langauges. If, for instance, your survey has English, French and Spanish asthe survey languages, then you can send respondents either an English, French, Spanish Link, or the default Online Deployment URL that will use the default survey language. If your survey does not have multiple languages, then the language dropdown will not be visible.

.. figure:: ../../resources/publish/multiple_language_dropdown.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Multiple Language Dropdown

	*Figure 9.1* French Online Deployment URL

As you'll notice, French has been selected, and the "Online Deployment URL" immediately switches to langfra (Indicating French)

Embed Code
^^^^^^^^^^

An alternative way to expanding your surveys horizons via the usual routine, eg., e-mails, QR codes, Social Networking, it is possible to embed the survey directly into your web site, so anyone who visits the site will be able to take the survey via an IFRAME.

.. figure:: ../../resources/publish/embed_code.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Embed Survey Code

	*Figure 9.1* Embed Code

You can manually add extra HTML code (to change the height and width, for example) directly into the code. When editing your web site to include your survey, you can refresh your website at any time to preview the changes in your survey. 

The survey will take on the default style that we provide and the themer will allow you to dynamically modify what your survey looks like.

If you have `WordPress`_, you can take the provided code and copy and paste it into a “Post” or “Page”.

.. _WordPress: http://www.wordpress.com

Email Invitations
^^^^^^^^^^^^^^^^^

FluidSurveys’ comes equipped with an invitation module through which survey links can be sent to potential respondents via email. To learn more about Email Invitations, refer to the "Invites" section of the manual.

Custom Survey Panel
^^^^^^^^^^^^^^^^^^^


3 part process

Collecting responses from your target audience 


Website Popups
^^^^^^^^^^^^^^

Popups can be the fastest, and eastiest and most effective way for site visitors to come back. Track visitor opinions, gauge trend popularity, and find out what your web site visitors are thinking with a FluidSurveys survey and a Popup. One way to distribute a survey is via a pop-up window on your website. 

.. figure:: ../../resources/publish/pop_up.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Popup example

	*Figure 9.1* How a popup looks like

Click "Add new popup" to get started. A new screen will slowly fade into view, which contains all necessary control options as defined below.

.. figure:: ../../resources/publish/pop_up_settings.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Settings popup

	*Figure 9.1* Available settings for a popup

.. list-table:: 
	:widths: 30 70
	:header-rows: 1

	* - Section
	  - Description
	* - 1. Name
	  - The name is simply a label for indentification purposes when viewing your list of popups. The user who views the popup will not see this label.
	* - 2. Identifier
	  - This value will be used to set the cookie preventing the popup from being shown twice. You may leave this blank to use a unique identifier, or set it to a custom value. If you use a custom value, all popups sharing this value will check for this value before being displayed. This allows you to have mulitple popups on multiple pages but only present the user with one.
	* - 3. Enabled
	  - Allows you to quickly enable or disable this popup. This way you can leave the code for the popup on your website, but if you disable the popup here, it will not appear to any visitors.
	* - 4. Pop Over
	  - Force this popup to stay in the foreground. By default (disabled) the script will attempt to put the displayed survey in the background if the browser allows it. Checking this will attempt to show the window the survey appears in above the current window
	* - 5. Use Standby Page
	  - If this option is enabled, when the user accepts the survey offer, the window popping up in the background will show the standby page first. The standby page will display the message set on the messages tab and contain a link to the survey, but encoureages the user to finish browsing. When the user leaves the domain, the standby page automatically redirects to the survey. However, to use this successfully, the standby page must be hosted on your server.
	* - 6. Display Effect
	  - Select an effect to use when displaying t he popup.
	* - 7. Language
	  - Determins which language the survey will be displayed in if your survey uses mulitple languages. Since we are unable to detect which langauge your user would prefer, you will nee dto create multiple popups, or duplicate an existing one and place the code for the correct langauge on the corresponding page of your site. The user may still change the survey language once they vist the survey, reglardess of which langauge it was started in.
	* - 8. Percentage
	  - Percentage value between 0 and 100%. Your popups will only be shown to this percentage of people. If you set this value to 10%, abolut 1 in 10 people will see your popups. You may use floating point values such as 0.5% for 1 in 200. For frequency, every X visitor will be shown your popup, while with percentage, each visitor has an X% chance of being shown your popup.
	* - 9. Frequency
	  - Dispaly your popup to every x vistior. If this value is set to 5, every 5th visitor will see your popup. 5, 10, 20, etc. This is checked before the percetnage value, so if you have frequency set to 5, and percentage set to 25%, every 5th visitor has a 25% chance of seeing your popup. For percentage, every visitor has X% chance of being shown your popup, where with frequency every X visitor is guaranteed to see the popup.
	* - 10. Delay
	  - Delay (in seconds) before the popup will appear to a visitor on your page
	* - 11. Postpone Length
	  - The length of time (in hours) before a user will be eligible to see the popup again after they were not shown it based on either frequency or percentage limitations. Set this to -1 and the user will not see the popup a second time, unless they clear htier cookies.
	* - 12. Save Changes
	  - Save all changes done
	* - 13. Preview
	  - Preview how your popup will look like
	* - 14. Undo Changes
	  - Undo all changes
	* - 15. Duplicate
	  - Duplicate this popup
	* - 16. Delete
	  - Delete this popup

Create a 2D Bar Code
^^^^^^^^^^^^^^^^^^^^

Smartphones are becoming more and more common, and a popular way of getting a survey onto a phone is via QR Codes. Like a barcode, the QR code contains all necessary information for your survey to be loaded when scanned via the phones barcode reader. The phone can scan the QR code and be instantly transported to your survey. Each and every survey you create will produce an entirely unique QR code. 

You can include this image on your website or on printed material to enable mobile device users to quickly and easily access your survey. To download a QR code for a survey, right click the image and click 'Save Image As', or click the 'Save Image' button at the bottom of this dialog. 

.. figure:: ../../resources/publish/qr_code.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: QR Code

	*Figure 9.1* Sample QR Code. Try it out.

Offline Mode
^^^^^^^^^^^^

No matter where we go, it seems as if we can always access the internet, be it on our laptops, phones or tablets. Whether we’re in a coffee shop or on a bus, our favourite websites are just a click away.

It’s something that’s often taken for granted. There are numerous situations, after all, in which obtaining internet access isn’t so easy. Perhaps we’re working in the field in a remote area, or we’re at a trade show where the connection is unreliable. Collecting data in such situations is often necessary, but difficult.

Through the use of Offline Mode, it is easy and economical to gather survey response data offline on any PC or tablet, and have it uploaded to a centralized database (FluidSurveys.com) once a connection has been re-established.

.. figure:: ../../resources/publish/offline_survey_mode.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Offline Survey

	*Figure 9.1* Offline survey

.. list-table:: 
	:widths: 30 70
	:header-rows: 1

	* - Section
	  - Description
	* - 1. Options
	  - When an Internet connection is established on a devise, **[Upload]** will upload all your responses to its online counter-part. Conversely, if an Internet connection can never be instituted, then **[Export to CSV]** will export all current response data to a Microsoft Excel (.csv) wherein the "Import Responses" can be used. When a new response is to be entered, when **[New Response]** is clicked, a respondent will go through the survey, while remaining Offline
	* - 2. Response Row(s)
	  - A row constains 1 response.

Designed to run in locations where offline data collection is required (limited or no internet access), FluidSurveys’ Mobile Surveys offer a much more convenient and powerful method than traditional pen & paper.

Sales personnel can now gather feedback as they meet with new clients, researchers can collect data in the field where wireless connections are unavailable, and organizations can set up survey stations at trade shows, kiosks, malls, etc without relying on an internet connection.

Share With Networks
^^^^^^^^^^^^^^^^^^^

Any survey you create can keep itself close to the pulse of Internet society with the click of a button. You can easily deploy your survey directly on any of your social networks:

.. figure:: ../../resources/publish/share_with_networks.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Share with Networks

	**Left to right:** `Twitter`_, `Facebook`_, `Digg`_, `Reddit`_, `Delicious`_

.. _Twitter: http://www.twitter.com
.. _Facebook: http://www.facebook.com
.. _Digg: http://www.digg.com
.. _Reddit: http://www.reddit.com
.. _Delicious: http://www.delicious.com

To perform a social network release, click on “Publish” and then select which web site you wish to post on. A popup window will appear asking for your login credentials, and once the information has been entered, you’re done. It’s easy as 1 – 2 – 3

Kiosk Mode
^^^^^^^^^^