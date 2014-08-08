<?php
namespace MOC\IV\Core\Update\Gui\EndPoint;

require_once( __DIR__.'/../../../../Api.php' );

use MOC\IV\Api;

$Config = Api::runUpdate()->apiGitHub()->buildConfig( __DIR__.'/../../GitHub/Config.ini' );

$Template = Api::groupCore()->unitDrive()->apiFile( __DIR__.'/CurrentVersion.html' )->getContent();

$Template = str_replace( '${Version}', $Config->getVersion()->getVersionString(), $Template );

print $Template;
