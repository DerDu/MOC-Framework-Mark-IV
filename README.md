MOC-Framework (Mark IV)
=======================
The easy way to OOP

Mind the task - forget the obstacles...
---------------------------------------

- PHP 5.3.0

------------------------------------------------------------------------------------------------------------------------

Please take into account that current versions of MOC-Framework and plugins could contain serious bugs.
Don't use them in production environments.

Be also aware that current interfaces may change rapidly

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/708afcd6-5202-4d62-8a8b-99d68cae5d9b/big.png)](https://insight.sensiolabs.com/projects/708afcd6-5202-4d62-8a8b-99d68cae5d9b)

Usage
-----

1. Get in the MOC

	```php
	require('Api.php');
	```
2. Start your engine

	```php
	use MOC\IV\Api;
	```
3. Put the pedal to the metal.

	```php
	print Api::useModule()->useEncoding()->useText('Latin-Chars öäüß')->getTextConvertedToUtf8();
	```
