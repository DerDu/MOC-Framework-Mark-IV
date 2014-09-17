<?php
namespace MOC\MarkIV\Core\Update\Gui\EndPoint;

require_once( __DIR__.'/../../../../../Api.php' );

use MOC\MarkIV\Api;
use MOC\MarkIV\Core\Update\GitHub\Source\Type\Blob;
use MOC\MarkIV\Core\Update\GitHub\Source\Type\Release;

Api::runBootstrap();

$Config = Api::runUpdate()->apiGitHub()->buildConfig( __DIR__.'/../../Config.ini' );

if ($Config->getChannelActiveRelease()) {

    $ReleaseList = Api::runUpdate()->apiGitHub()->buildChannel( $Config )->getChannelNightly( true );

    if (false === $ReleaseList) {

        $Template = Api::groupCore()->unitDrive()->apiFile( __DIR__.'/ChannelError.html' )->getContent();
        $Template = str_replace( '${Retry}',
            Api::runUpdate()->apiGitHub()->buildChannel( $Config )->getChannelRetryTimestamp(), $Template );

        print $Template;

    } else {

        if (empty( $ReleaseList )) {

            print Api::groupCore()->unitDrive()->apiFile( __DIR__.'/ChannelEmpty.html' )->getContent();

        } else {

            /** @var Release $Release */
            foreach ((array)$ReleaseList as $Release) {
                if ($Release->getTag()->getIdentifier() == $_REQUEST['data-rel']) {

                    $Template = Api::groupCore()->unitDrive()->apiFile( __DIR__.'/Install.html' )->getContent();

                    $Template = str_replace( '${Version}', $Release->getVersion()->getVersionString(), $Template );
                    $Template = str_replace( '${Name}', $Release->getName(), $Template );
                    $Template = str_replace( '${Description}', $Release->getDescription(), $Template );

                    $BlobList = $Release->getTree()->getBlobList();

                    $Template = str_replace( '${Count}', count( $BlobList ), $Template );

                    $Size = 0;
                    /** @var Blob $Blob */
                    foreach ((array)$BlobList as $Blob) {
                        $Size += $Blob->getSize();
                    }

                    $Template = str_replace( '${Size}', $Size, $Template );

                    $Template = str_replace( '${Identifier}', $Release->getTag()->getIdentifier(), $Template );
                    $Template = str_replace( '${Type}', 'Nightly', $Template );

                    print $Template;

                    break;
                }
            }

        }

    }
} else {

    $Template = Api::groupCore()->unitDrive()->apiFile( __DIR__.'/ChannelDisabled.html' )->getContent();

    print $Template;
}
