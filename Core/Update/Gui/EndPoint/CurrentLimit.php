<?php
namespace MOC\MarkIV\Core\Update\Gui\EndPoint;

require_once( __DIR__.'/../../../../Api.php' );

use MOC\MarkIV\Api;

$Config = Api::runUpdate()->apiGitHub()->buildConfig( __DIR__.'/../../GitHub/Config.ini' );

$Limit = Api::runUpdate()->apiGitHub()->buildChannel( $Config )->getChannelLimit();

print $Limit;
