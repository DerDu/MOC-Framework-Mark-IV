<?php
namespace MOC\MarkIV\Extension\Documentation\Gui\EndPoint;

require_once( __DIR__.'/../../../../Api.php' );

print \MOC\MarkIV\Api::groupExtension()->unitDocumentation()->apiGenerator(
	\MOC\MarkIV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/../../../../' ),
	\MOC\MarkIV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/../../../../Documentation/Content/' )
)->createDocumentation();
