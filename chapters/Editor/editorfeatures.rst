Editor Features
---------------

Survey Title/Survey Description
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The Survey Title is what respondents see when they’re treading through your survey. When a survey is first created, the survey title is inherited from the survey name. It can be modified by clicking on the “survey tab” at the top of the editor. The survey title will appear at the top of every page.


.. figure:: ../../resources/editor/survey_title.png
	:align: center
	:scale: 70%
	:alt: Survey Title
	:class: screenshot

	*Figure 5.1* Depiction of a survey title on a 1 page survey

.. admonition:: Survey Title Restriction

	The survey title cannot be longer than 50 characters. However, the survey title that respondents see can be edited later to include:

		* More than 50 characters
		* HTML
		* CSS
		* JavaScript

.. tip::

	An option is available to have the Survey Title and Extra Description only show up on the first page. To enable it, follow these easy steps:

		1. In the Editor, click the title
		2. Select the option, "First page title/description only"


Keyboard Shortcuts
^^^^^^^^^^^^^^^^^^

Since time is money, and FluidSurveys already accommodates a low cost survey alternative, we allow for the administrator to save a few clicks by providing essential keyboard shortcuts.

.. list-table:: 
	:widths: 30 20 60
	:header-rows: 1

	* - Section
	  - Shortcut
	  - Description
	* - 1. Save
	  - CTRL-S
	  - Save the survey in its current form.
	* - 2. Select All Questions
	  - CTRL-A
	  - Select all questions on the current page.
	* - 3. Copy Questions
	  - CTRL-C
	  - Copy the selected question(s)
	* - 4. Paste Questions
	  - CTRL-V
	  - Paste the question(s) in the clipboard
	* - 5. Delete
	  - CTRL-D or Delete
	  - Delete the selected question(s)
	* - 6. Next Page
	  - Page Down
	  - Traverse to the next page
	* - 7. Previous Page
	  - Page Up
	  - Go back to previous pages

Save
^^^^

With any plan, free or paid, the survey can be saved at any point by clicking the [Save] button in edit survey mode. There are 3 ways to save your survey:

	1. [Save] button found on the floating Editor box
	2. [Save] button found on the top-bar
	3. [Ctrl] + S on the keyboard

.. figure:: ../../resources/editor/3_ways_to_save.png
	:align: center
	:class: screenshot
	:alt: Multiple ways to save your survey
	:scale: 70%

	*Figure 5.2* The 3 places you can save your survey

.. warning::

	Before leaving the survey, you will be presented with a pop-up reminding you to save. If you spent hours perfecting the look-and-feel of your survey, and you forgot to save, only to close the page, you will unfortunately be presented with a lot of missing time the next time you load it up. 

	.. image:: ../../resources/editor/confirm_navigation.png
		:align: center
		:class: screenshot
		:alt: Confirm Leaving the Page
		:scale: 70%

Preview
^^^^^^^

.. figure:: ../../resources/editor/quick_links_preview.png
	:align: center
	:class: screenshot
	:alt: Preview Button
	:scale: 70%

	*Figure 5.3* Preview quick link icon

The Preview Survey button can be found within the Editor, but it is also possible to preview the survey from the Survey Dashboard screen. Clicking on preview will open a new browser window to test you survey (Figure 5.3). The survey will appear exactly as it would to a survey respondent, except for a black bar across the top of the page. The black bar won't be there for the respondents, but it's there for you -- the Administrator -- because it contains some simple tools to help you test your survey with ease and flexibility.

.. figure:: ../../resources/editor/administrator_toolbar.png
	:align: center
	:class: screenshot
	:alt: Administrator Toolbar
	:scale: 70%

	*Figure 5.4* Administrator toolbar on a 2 page survey

.. list-table::
	:widths: 25 75
	:header-rows: 1

	* - Section
	  - Description
	* - 1. Download Responses
	  - If your survey contains multiple pages, you can download responsens right from the top bar without having to enable the option under the :ref:`Publish` settings. You can download them into 
	    either Microsoft Word or Adobe Reader.
	* - 2. Jump to page
	  - Instead of having to click [Next] a multitude of times in order to get to your desired page, you can instantly jump there. This will save you time, and headache.
	* - 3. Test Data
	  -	When you preview your survey, you will notice that in the address bar the code /?TEST_DATA is appended at the end. This allows for you to quickly distinguish between actual data, and data you entered during the testing phase. To learn more about the response table, please see the :ref:`Analyze` section of the manual.

To learn more about Preview, see the :ref:`Preview` section of the manual

Publish
^^^^^^^

.. figure:: ../../resources/editor/quick_links_publish.png
	:align: center
	:class: screenshot
	:alt: Publish Button
	:scale: 70%

	*Figure 5.5* Administrator toolbar on a 2 page survey

The Publish button can be found within the Editor, but it is also possible to alter any publishing options for a survey from the Survey Dashboard screen. Clicking on Publish will direct you to edit any necessary publishing options, such as closing the survey, access restrictions, all the way to changing the survey completed message. 

To learn more about Preview, see the :ref:`Publish` section of the manual

.. note:: 

	All surveys are [Live] by default. You can [Close] at any point. To learn more, see the :ref:`Publish` section of the manual

Find & Replace
^^^^^^^^^^^^^^

Find & Replace can automatically locate and replace text or phrases in question titles, choices, variables, extra description fields within a survey for your keyword, replacing them with a few clicks. A dialogue will appear allowing you to specify the text to locate, and what to replace it with. You can also specify where the changes should be made, be it in the entire survey, on one page, or for selected questions.

In addition, you can use `Regular Expressions`_ when searching for a keyword

.. _Regular Expressions: http://en.wikipedia.org/wiki/Regular_expression

.. figure:: ../../resources/editor/find_and_replace_bincoluars.png
	:align: center
	:class: screenshot
	:alt: Find and Replace
	:scale: 70%

	*Figure 5.6* Find & Replace binoculars

.. figure:: ../../resources/editor/find_and_replace_popup.png
	:align: center
	:class: screenshot
	:alt: Find and Replace Popup
	:scale: 70%

	*Figure 5.6* Find & Replace Options

.. list-table::
	:widths: 30 70
	:header-rows: 1

	* - Section
	  - Description
	* - 1. Replace
	  - Input the string you'd like to search for in either the "Entire Survey", "This Page" or "Selected Questions"
	* - 2. With
	  - What would you like to replace the string with?
	* - 3. In
	  - Select from the following locations to search for the string

.. image:: ../../resources/editor/fr_dropdown.png
	:align: center
	:class: screenshot
	:alt: Task Icons
	:scale: 70%

.. list-table::
	:widths: 30 70
	:header-rows: 0

	* - 
	  - 
	  	1. **Selected Questions** - Only look within selected questions
		2. **This Page** - Only search the active page
		3. **Entire Survey** - Search the entire page
	* - 4. Use Regular Expressions
	  - Allows for a deeper Find & Replace experience. To learn more about RegEx, please refer to the web site above.

.. tip::

	Using Regular Expressions, find all numbers in a survey and replace it with the string "FluidSurveys"

		1. Click on [Find and Replace]
		2. Select "Entire Survey" under "In"
		3. Enable "Use Regular Expressions"
		4. In "Replace" put "\d+" (Find all decimal numbers)
		5. In "With" put "FluidSurveys"
		6. Click [Replace]

Survey Versioning
^^^^^^^^^^^^^^^^^

Survey Versioning can restore up to 50 previous versions of your survey. This can be very useful in the case that accidental deletions or unwanted changes are made. To view and revert to a previous version of your survey, click on the "View Previous Versions" (Small Calendar) in the top-bar at the top of the Editor.

.. figure:: ../../resources/editor/survey_version_calendar.png
	:align: center
	:class: screenshot
	:alt: View Survey Versions
	:scale: 70%

	*Figure 5.7* View Survey Versions calendar

A dialog will then appear listing all of the saved versions of the survey. You can first view the different versions, and if you’d like to restore your survey to one of the previously saved version, click [Revert]
 
.. figure:: ../../resources/editor/survey_versions_previous_versions.png
	:align: center
	:class: screenshot
	:alt: Previous Versions pop-up
	:scale: 70%

	*Figure 5.8* Your surveys previous versions pop-up

.. list-table::
	:widths: 20 80
	:header-rows: 1

	* - Section
	  - Description
	* - 1. Revisions
	  - Everytime you [Save] your survey, a revision is created of the previous one. The dropdown will show all (50 at most) previous versions
	* - 2. Revert
	  - The selected survey will load once the page is refreshed.
	* - 3. View
	  - A new window will appear, showing the selected revision. It is possible to cycle through all versions by clicking the blue forward, or backward arrow

.. image:: ../../resources/editor/previous_versions.png
	:align: center
	:class: screenshot:
	:alt: Cycle through previous survey versions
	:scale: 70%

.. list-table::
	:widths: 20 80
	:header-rows: 0

	* -
	  -	Move forward (next version) or move backward (previous version) without having to constantly close the pop-up window

.. tip::

	A situation may arise where you only want to restore parts of a survey, perhaps one or two questions. In that case, first click on the “View Previous Versions” link at the top of the editor.

		1. Click the "View Survey Versions" calendar
		2. Find the version you think the question was in last
		3. Click the [View] button
		4. In the new window showing that version of the survey, find the question
		5. Copy ([Ctrl] + c) the question
		6. Close the previous survey version windows, and paste ([Ctrl] + v) into your present survey

Page Drag-and-Drop
^^^^^^^^^^^^^^^^^^

The concept is really simple. At any point, instead of moving each question individually from 1 page to another, you can quickly and efficently move the entirety of 1 page to an entirely different location in your survey.The goal is to click, drag, and release the page in its new desired spot.

.. figure:: ../../resources/editor/drag_pages_around.png
	:align: center
	:class: screenshot:
	:alt: Change page order
	:scale: 70%	

	*Figure 5.9* Drag and Drop a page in a new slot within your survey

Page Labels
^^^^^^^^^^^

Page labels allow you to create named pages of your survey that can then be branched to or jumped to. Page labels do not have a character type restriction, eg., #@!&$%, or character limit

.. figure:: ../../resources/editor/change_page_label.png
	:align: center
	:class: screenshot
	:alt: An altered page label
	:scale: 70%	

	*Figure 5.9* Altered page label

.. tip:: 

	To change the page title, here's how:

		1. Click on the [Page] tab wihtin a surveys Editor page
		2. Under "Page Label" input your new page title

Right-click Menu
^^^^^^^^^^^^^^^^

.. figure:: ../../resources/editor/right_click_menu.png
	:align: center
	:class: screenshot
	:alt: The right-click menu
	:scale: 70%	

	*Figure 5.9* Right-click menu

.. list-table::
	:widths: 30 80
	:header-rows: 1

	* - Section
	  - Description
	* - 1. Cut
	  - Cut the selected question(s). If more than 1 question is selected, then those questions will be cut when [Cut] is clicked.
	* - 2. Copy
	  - Copy the selected question(s). If more than 1 question is selected, then those questions will be copied when [Copy] is clicked.
	* - 3. Paste
	  - Paste the questions on the clipboard
	* - 4. Delete
	  - Delete the selected question(s). If more than 1 question is selected, then those questions will be deleted when [Delete] is clicked.
	* - 5. Move To
	  - Move the selected question(s) to a new page. If more than 1 question is selected, then those questions will be moved when [Move To] is clicked
	* - 6. Duplicate
	  - Duplicate the selected question(s). If more than 1 question is selected, then those questions will be duplicated when [Duplicate] is clicked.
	* - 7. Change Question Type
	  - If an incorrect question type was used for a question, you can easily morph it to the appropriate one. 
	    To learn more about the Piping Wizard, please refer to the :ref:`Advanced Features` section of the manual
	* - 8. Piping Wizard
	  - Pipe previously inputted answers by a respondent into a question. 
	    To learn more about the Piping Wizard, please refer to the :ref:`Advanced Features` section of the manual
	* - 9. Mark all as optional
	  - The selected question(s) will be marked as optional. If more than 1 question is selected, then only those questions will be marked as optional
	* - 10. Mark all as required
	  - The selected question(s) will be marked as required. If more than 1 question is selected, then only those questions will be marked as required
	

Add questions (Drag-and-drop)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The concept is really simple. The Editor is divided into two sides. The left side includes all of the different question types that can be used to construct a survey. The right hand page is simply a blank sheet of paper that is used to construct a survey. The goal is to click drag, and release a question from the left side of the page onto the right side of the page. It’s really very easy and fast. Try it for yourself to see what we mean!

.. figure:: ../../resources/editor/drag_and_drop.png
	:align: center
	:class: screenshot:
	:alt: Drag and drop from left to right
	:scale: 70%	

	*Figure 5.9* Drag and Drop from Left to Right

Add questions (Double click)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Question Morphing
^^^^^^^^^^^^^^^^^

Bulk
^^^^

Templates (Save, Apply)
^^^^^^^^^^^^^^^^^^^^^^^

Show Branching/Skip Info
^^^^^^^^^^^^^^^^^^^^^^^^

Visual Editor
^^^^^^^^^^^^^

The Rich Text Editor allows for you to easily insert images, add styling to text, YouTube videos, links, paste from Microsoft Word, etc. The Visual Editor can be used when editing the survey/question title or survey/question description. 

To access the Visual Editor, click on a text area in the floating box on the left hand side, and click [Open Visual Editor]. The visual editor appears as a typical text editor, with actions and commands located at the top. Any changes made in the visual editor will appear in your survey.

.. figure:: ../../resources/editor/visual_editor.png
	:align: center
	:class: screenshot:
	:alt: Visual Editor
	:scale: 70%	

	*Figure 5.9* The visual editor 

.. list-table::
	:widths: 30 80
	:header-rows: 1

	* - Section
	  - Description
	* - 1. 
	  - 

.. note::

	You can click [Source] button within the Visual Editor and input HTML, JavaScript or CSS
