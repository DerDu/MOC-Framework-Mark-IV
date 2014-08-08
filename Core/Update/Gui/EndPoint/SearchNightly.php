<?php
namespace MOC\IV\Core\Update\Gui\EndPoint;

require_once( __DIR__.'/../../../../Api.php' );

use MOC\IV\Api;
use MOC\IV\Core\Update\GitHub\Source\Type\Blob;
use MOC\IV\Core\Update\GitHub\Source\Type\Release;

$Config = Api::runUpdate()->apiGitHub()->buildConfig( __DIR__.'/../../GitHub/Config.ini' );

if( $Config->getChannelActiveNightly() ) {

	$ReleaseList = Api::runUpdate()->apiGitHub()->buildChannel( $Config )->getChannelNightly();

	if( false === $ReleaseList ) {
		print 'Error';
	} else {

		if( empty( $ReleaseList ) ) {
			print 'Empty';
		} else {

			/** @var Release $Release */
			foreach( (array)$ReleaseList as $Release ) {

				$Template = Api::groupCore()->unitDrive()->apiFile( __DIR__.'/SearchNightly.html' )->getContent();

				$Template = str_replace( '${Version}', $Release->getVersion()->getVersionString(), $Template );
				$Template = str_replace( '${Name}', $Release->getName(), $Template );
				$Template = str_replace( '${Description}', $Release->getDescription(), $Template );

				$BlobList = $Release->getTree()->getBlobList();

				$Template = str_replace( '${Count}', count( $BlobList ), $Template );

				$Size = 0;
				/** @var Blob $Blob */
				foreach( (array)$BlobList as $Blob ) {
					$Size += $Blob->getSize();
				}

				$Template = str_replace( '${Size}', $Size, $Template );

				$Template = str_replace( '${Identifier}', $Release->getTag()->getIdentifier(), $Template );

				print $Template;
			}

		}

	}
} else {

	$Template = Api::groupCore()->unitDrive()->apiFile( __DIR__.'/ChannelDisabled.html' )->getContent();

	print $Template;
}
