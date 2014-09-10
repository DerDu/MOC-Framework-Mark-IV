<?php
namespace MOC\IV\Extension\Documentation\Gui\EndPoint;

require_once( __DIR__.'/../../../../Api.php' );

print \MOC\IV\Api::groupExtension()->unitDocumentation()->apiGenerator(
	\MOC\IV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/../../../../' ),
	\MOC\IV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/../../../../Documentation/Content/' )
)->createDocumentation();
