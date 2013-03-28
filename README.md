## An Important Note About Support

Testee (in common with all of my ExpressionEngine add-ons) is no longer officially supported.

Check out the wiki for [installation and usage instructions][wiki], and feel free to fork the repo if you'd like to make some changes or improvements (it's distributed under a liberal open source license).

Hopefully this will be everything you need to use this add-on in your projects, but if not please don't email me asking for support; I don't even have ExpressionEngine installed locally any more.

[wiki]: https://github.com/experience/testee.ee_addon/wiki/ "View the documentation"

## Overview

Testee makes unit testing and test-driven development of ExpressionEngine 2 add-ons easy.

Behind the scenes, Testee takes care of all the hard work of replacing ExpressionEngine’s built-in objects with mock objects, allowing you to get on with writing tests safe in the knowledge that you’re not about to destroy your site.

Testee uses the [PHP SimpleTest framework][simpletest] to run your tests, and interpret the results. If you know how to write a SimpleTest unit test, you already know how to write a Testee unit test; and if you don’t, SimpleTest is [well documented][simpletest_docs].

[simpletest]:http://simpletest.org/ "Find out more about SimpleTest"
[simpletest_docs]:http://simpletest.org/en/unit_test_documentation.html "Read the SimpleTest documentation"

