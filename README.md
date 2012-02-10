# Writing Tests
The [SimpleTest documentation][simpletest_docs] provides detailed information on how to write your tests.

The primary difference between writing a standard SimpleTest test, and a Testee test, is that your unit test class must extend `Testee_unit_test_case`. For example:

	class My_first_test extends Testee_unit_test_case() {
		// Do stuff.
	}

As you might expect, Testee includes its own unit tests, which are a good way to familiarise yourself with add-on unit testing.

## Where to save your tests ##
Testee automatically looks for your tests in a specific location.

Create a directory inside `/system/tests/` with the same name as your add-on, and put your tests in there. For example, if your add-on is named `mazeltov`, put your tests in `/system/tests/mazeltov/`.

Test files must be named either `test.the_name_of_my_tests.php`, or `test_the_name_of_my_tests.php`.

[simpletest_docs]: http://simpletest.org/en/unit_test_documentation.html "The official SimpleTest documentation"

# Usage Instructions
Testee displays the available tests on the main module page, grouped by add-on. Select which tests you'd like to run, and click the "Run Tests" button. Testee runs the selected tests, and presents you with the results.

If everything passes, Testee displays a handsome green bar, and a summary of the completed tests. If any tests fail, Testee displays as much information as possible about each failed test.

### Keyboard friendly
In the spirit of rapid iteration, hitting "Enter" on the test results screen will automatically run the selected tests again.

You can also use your keyboard to navigate the list of available tests on the main module screen.

# Useful Resources
If you're completely unfamiliar with test-driven development, unit testing, mock objects, and other such exciting things, you're probably going to find this documentation a bit overwhelming.

Not to worry, here are a few resources to get you up and running:

* The [Wikipedia page on Unit Testing][wikipedia] is a good place to start.
* [Test-Driven Development by Example][beck_book], by Kent Beck, is an excellent (and gentle) introduction to the main tenets of TDD.
* Those who prefer the modern medium of moving pictures may enjoy the [Pragmatic Programmers screencasts][beck_cast], once again with Kent Beck.
* Unfamiliar with Agile? [Get schooled][agile_intro] by the ugliest page on the Internet.
* Once you've understood the principles, the [SimpleTest documentation][simpletest_docs] provides a wealth of practical information.

[agile_intro]: http://www.agile-process.org/ "I can haz whitespace, plz?"
[beck_book]: http://www.amazon.co.uk/Test-Driven-Development-Addison-Wesley-Signature/dp/0321146530/ref=sr_1_1?ie=UTF8&qid=1306782005&sr=8-1 "The book that started it all (for me)"
[beck_cast]: http://pragprog.com/screencasts/v-kbtdd/test-driven-development "Not my cup of tea, but others rave about it"
[simpletest_docs]: http://simpletest.org/en/unit_test_documentation.html "The official SimpleTest documentation"
[wikipedia]: http://en.wikipedia.org/wiki/unit_testing "Behold the sacred text"


# Installation Instructions
## Requirements
* PHP 5.
* ExpressionEngine 1.6.8, or later.
* The [jQuery for the Control Panel][jquery_cp] extension.

## Installation
1. Extract the ZIP file.
2. Copy `ee1/system/modules/testee` to your `/system/modules/` directory.
3. Copy `ee1/system/language/english/lang.testee.php` to your `/system/language/english/` directory.
4. Create a new `tests` directory in your `/system` directory.
5. Copy `ee1/system/tests/testee` to your `/system/tests/` directory.
6. Copy `ee1/themes/cp_themes/default/testee` to your `/themes/cp_themes/default/` directory.
7. Open [the Modules page][modules_ee1], and enable Testee.

[jquery_cp]: http://expressionengine.com/downloads/details/jquery_for_the_control_panel/ "In the old days, EE used to work without JavaScript. Seriously. No I'm not senile, you cheeky bastard. Bloody Jamie Rumbelow, makes me sick"
[modules_ee1]: http://expressionengine.com/legacy_docs/cp/modules/index.html "The EE1 Modules page."

# How It Works
Testee sits on top of [the SimpleTest framework][simpletest], inheriting all of its functionality. SimpleTest runs your tests and interprets the results, and Testee makes everything play nicely with ExpressionEngine.

Testee's main contribution to the testing process is in the form of mock objects. Whenever you run your tests, Testee quietly replaces all of the commonly-used ExpressionEngine objects with mock objects. Once your tests have completed, Testee reinstates the real ExpressionEngine objects, and everything continues as normal.

The whole process is completely seamless, and doesn't affect the normal operation of ExpressionEngine in any way.

By swapping the actual ExpressionEngine objects for their "mock" equivalents, Testee makes it possible for you to write tests such as this, without destroying your ExpressionEngine installation.

	public function test__delete_all_members__success()
	{
		$this->EE->db->expectOnce('empty_table', array('members'));
		$this->_test_subject->delete_all_members();
	}

Testee includes mocks of all the ExpressionEngine objects you're likely to encounter during your add-on development efforts.

You can find Testee's mock objects in the `/system/modules/testee/classes/mocks` directory.

[simpletest]: http://simpletest.org/ "Visit the SimpleTest website"