MOC-Framework (Mark IV)
=======================
The easy way to OOP

Simple, fast, extensible, unified interface to unlimited possibilities.

Mind the task - forget the obstacles...
---------------------------------------

- PHP 5.3.0

------------------------------------------------------------------------------------------------------------------------

Please take into account that current versions of MOC-Framework IV could contain serious bugs.
Don't use them in production environments.

Be also aware that current interfaces may change rapidly

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/708afcd6-5202-4d62-8a8b-99d68cae5d9b/big.png)](https://insight.sensiolabs.com/projects/708afcd6-5202-4d62-8a8b-99d68cae5d9b)

[![Coverage Status](https://coveralls.io/repos/DerDu/MOC-Framework-Mark-IV/badge.png?branch=development)](https://coveralls.io/r/DerDu/MOC-Framework-Mark-IV?branch=development)
[![Build Status](https://travis-ci.org/DerDu/MOC-Framework-Mark-IV.svg?branch=development)](https://travis-ci.org/DerDu/MOC-Framework-Mark-IV)

Usage
-----

1. Get in the MOC

	```php
	require('Api.php');
	```
2. Start your engine

	```php
	use MOC\MarkIV\Api;
	```
3. Put the pedal to the metal.

	```php
	print Api::groupModule()->unitEncoding()->apiText('Latin-Chars öäüß')->getUtf8();
	```

Full API-Documentation visit <http://derdu.github.io/MOC-Framework-Mark-IV>

Version
-------

Version number MAJOR.MINOR.PATCH.BUILD:

- MAJOR version: incompatible API changes,
- MINOR version: add functionality in a backwards-compatible manner
- PATCH version: backwards-compatible bug fixes.
- BUILD version: internal development tags

Structure
---------

- Root:
	- Bootstrap-Api
	- Group-Factory
		- ```group{Name}()```
- Level A:
	- Group-Api
	- Unit-Factory
		- ```unit{Name}({Dependency,..})```
- Level B:
	- Unit-Api
	- Object-Factory
		- ```api{Name}({Dependency,..})```
- Level C:
	- Object-Api
		- ```set{Property}({Value})```
		- ```get{Property}()```
		- ```{action}{ReferenceName}({Dependency,..})```

Goals
-----

- Seamless and simple interface
- Exchangeable code structure
- Maximum flexible factory (dependency injection)
- Minimal api setter usage

3rd-Party Software (3PS) used by MOC
------------------------------------

***apigen*** to create the documentation

	Project: <https://github.com/apigen/apigen>
	License: BSD
	Version: 2.8.0

***PHPMailer*** to add mail capability

	Project: <https://github.com/PHPMailer/PHPMailer>
	License: LGPL
	Version: 5.2.8
