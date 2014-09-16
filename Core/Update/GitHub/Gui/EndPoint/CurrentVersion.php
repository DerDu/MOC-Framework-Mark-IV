<?php
namespace MOC\MarkIV\Core\Update\Gui\EndPoint;

require_once( __DIR__.'/../../../../../Api.php' );

use MOC\MarkIV\Api;

Api::runBootstrap();

$Config = Api::runUpdate()->apiGitHub()->buildConfig( __DIR__.'/../../Config.ini' );

print $Config->getVersion()->getVersionString();
