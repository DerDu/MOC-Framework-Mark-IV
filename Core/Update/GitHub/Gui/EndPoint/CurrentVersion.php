<?php
namespace MOC\MarkIV\Core\Update\Gui\EndPoint;

require_once( __DIR__.'/../../../../../Api.php' );

Api::runBootstrap();

use MOC\MarkIV\Api;

$Config = Api::runUpdate()->apiGitHub()->buildConfig( __DIR__.'/../../Config.ini' );

print $Config->getVersion()->getVersionString();
