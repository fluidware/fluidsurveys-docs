Basic Questions
---------------

The complete set of question types are available to Enterprise customers.

.. note::

	To learn more about each question types available Options, please refer to the :ref:`Question Options` section of the manual.

Section Heading
^^^^^^^^^^^^^^^

Section Separators allow survey creators to include text within their survey without actually asking a question. It can be used to include an introduction or some explanatory text in your survey, pictures, endnotes, etc. If ever you simply need to convey a message without explicitly asking a question, then a Section Separator can satisfy such a role.


.. figure:: ../../resources/editor/section_heading.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Section Heading

	*Figure 6.1* Section Heading Question Type

.. note::

	Despite being able to provide a Section Separator with a unique identifier, you cannot attach advanced logic branching rules to the question type.

Yes/No
^^^^^^

A Yes/No question type is the simplest question type that we have. It has a default scoring mechanism of 1 (Yes) and 2 (No), and the choices are translated to their appropriate language when multiple languages resides on a survey. Yes/No questions are perfect when you need quick and easy page skipping based on the response.

.. figure:: ../../resources/editor/yes_no.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Yes No 

	*Figure 6.1* Yes/No Question Type

Including multiple languages on your survey will automatically include the appropriate translation for “Yes/No”. Therefore, Yes/No questions by default become perfect tools as “Do you agree?” pivot questions. 

.. figure:: ../../resources/editor/yes_no_french.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Yes No French

	*Figure 6.1* Yes/No Question Type in French

.. note::

	The "Question Title" and "Extra Description" are not automatically translated by FluidSurveys. They will need to be translated separately.

Text Response
^^^^^^^^^^^^^

A Text Response question type allows for surveyors to ask a user to type either the answer out, or provide specific textual information (phone number, address, etc…). Text Response questions come with text validation ranging from Email addresses, Currency, all the way to Percentages.

.. figure:: ../../resources/editor/text_response.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Text Response

	*Figure 6.1* Text Response Question Type

Enabling the Multiline option and indicating the number of columns can create the perfect storm for allowing users to fill in text, which can also be restricted to a certain amount of words. The example below has a Text Response question type with multiline enabled, 50 columns, and All Characters validation of 2000 (roughly 200 words) which will cease to accept words after that point.

.. figure:: ../../resources/editor/text_response_customized.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Customized Text Response

	*Figure 6.1* Text Response with 100 columns and 10 rows

Checkbox
^^^^^^^^

The checkbox question type is a multi-answer question, as in you can select more than one answer. Checkbox choice can contain a text response (which can have Validation) beside each choice, as well as an “Other, Please Specify” option which is an exclusive choice (Selecting it, or typing into the text area, will automatically deselect all options and select the other). 

.. figure:: ../../resources/editor/check_box.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Checkbox Question Type

	*Figure 6.1* Checkbox Question Type

Multiple Choice
^^^^^^^^^^^^^^^

The Multiple choice question type, commonly referred to as the single choice question type, allows for a user to provide one answer per question, whereas a checkbox question type allows for the user to specify more than one answer. Each choice has branching, skipping, and validation capabilities available. The display options are slightly different, in that you can change the views (Horizontal, Vertical, Combo box, Star Rating – see blow –). Star Ratings, generally used for a rating between 1 and an end value, allow for the rating to exist on a horizontal star level. 

.. figure:: ../../resources/editor/multiple_choice.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Multiple Choice Question Type

	*Figure 6.1* Multiple Choice Question Type

Dropdown
^^^^^^^^

The dropdown question type is exactly what the name entails; an answer found and selected in a dropdown fashion. Also, similarly to a multiple choice question, the dropdown question type allows for only one answer. 

.. figure:: ../../resources/editor/drop_down.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Dropdown Question Type

	*Figure 6.1* Dropdown Question Type

Date/Time
^^^^^^^^^

A Date/Time question allows for the user to select a specific year, month, day as seen below. Date/Time questions are perfect when either trying to determine when an incident happened, or even when finding the perfect time to have a meeting. The question type essentially allows for a user to record the date and time with five types of configurations; Date/Time, Date Only, Time Only, Date/Month, and Month/Year.

The default display format is Date/Time. 

.. figure:: ../../resources/editor/date_time.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Date/Time Question Type

	*Figure 6.1* Date/Time Question Type

The Date/Time can be customized to accepted either only:

	* Date/Time
	* Date only
	* Time only
	* Day/Month 
	* Month/Year

.. note:: 

	Despite not accepting military standard time, if the user enters 21:00, the question type will convert it to 9:00 pm


Text Response Grid
^^^^^^^^^^^^^^^^^^

In short, a Text Response Grid allows for the surveyor to ask a series of question with a set of validation types applied (Numerical, Text only, All Characters, etc…) which will present an error to the user if the validation was not adhered to. 

.. figure:: ../../resources/editor/text_response_grid.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Text Response Grid Question Type

	*Figure 6.1* Text Response Grid Question Type

Multiple Choice Grid
^^^^^^^^^^^^^^^^^^^^

The Multiple Choice Grid question type is in essence a Likert question. This question type heralds in a new option, make column static, which will keep the most left column (with all the variables in question) static as you drag the scrollbar to the right. 

.. figure:: ../../resources/editor/multiple_choice_grid.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Multiple Choice Grid Question Type

	*Figure 6.1* Multiple Choice Grid Question Type

Dropdown Grid
^^^^^^^^^^^^^

Dropdown Grid is similar to its sibling, the dropdown question, in that it is still similar to a multiple choice question, with a single answer only. This  is the direct opposite of a checkbox question, which can have many answers. 

.. figure:: ../../resources/editor/drop_down_grid.png
	:scale: 70%
	:align: center
	:class: screenshot
	:alt: Dropdown Grid Question Type

	*Figure 6.1* Dropdown Grid Question Type