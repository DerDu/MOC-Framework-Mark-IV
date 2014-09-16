<?php
namespace MOC\MarkIV\Extension\Documentation\ApiGen\Gui\EndPoint;

use MOC\MarkIV\Api;

require_once( __DIR__.'/../../../../../Api.php' );

Api::runBootstrap();

print Api::groupExtension()->unitDocumentation()->useApiGen(
	Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/../../../../../' ),
	Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/../../../../../System/Documentation/Content/' )
)->createDocumentation();
