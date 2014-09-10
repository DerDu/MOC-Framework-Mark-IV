<?php
namespace MOC\MarkIV\Extension\Documentation\Generator;

use ApiGen\Config;
use Nette\Config\Adapters\NeonAdapter;

\MOC\MarkIV\Api::registerAdditionalNamespace(
	'ApiGen', \MOC\MarkIV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/3rdParty/apigen' )
);
\MOC\MarkIV\Api::registerAdditionalNamespace(
	'TokenReflection', \MOC\MarkIV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/3rdParty/apigen/libs/TokenReflection' )
);
\MOC\MarkIV\Api::registerAdditionalNamespace(
	'FSHL', \MOC\MarkIV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/3rdParty/apigen/libs/FSHL' )
);
//require_once( __DIR__.'/3rdParty/apigen/libs/Nette/Nette/loader.php' );
//require_once( __DIR__.'/3rdParty/apigen/libs/Texy/texy/texy.php' );


/**
 * Interface IApiInterface
 *
 * @package MOC\MarkIV\Extension\Documentation\Generator
 */
interface IApiInterface {

	/**
	 *
	 */
	public function createDocumentation();
}

/**
 * Class Api
 *
 * @package MOC\MarkIV\Extension\Documentation\Generator
 */
class Api implements IApiInterface {

	/** @var \MOC\MarkIV\Core\Drive\Directory\IApiInterface|null $Source */
	private $Source = null;
	/** @var \MOC\MarkIV\Core\Drive\Directory\IApiInterface|null $Destination */
	private $Destination = null;

	/**
	 * @param \MOC\MarkIV\Core\Drive\Directory\IApiInterface $Source
	 * @param \MOC\MarkIV\Core\Drive\Directory\IApiInterface $Destination
	 */
	function __construct( \MOC\MarkIV\Core\Drive\Directory\IApiInterface $Source, \MOC\MarkIV\Core\Drive\Directory\IApiInterface $Destination ) {

		$this->Source = $Source;
		$this->Destination = $Destination;
	}

	private function getConfig() {

		return array(
			// Source file or directory to parse
			'source'       => $this->Source->getLocation(),
			// Directory where to save the generated documentation
			'destination'  => $this->Destination->getLocation(),
			// List of allowed file extensions
			'extensions'   => array( 'php' ),
			// Mask to exclude file or directory from processing
			'exclude'      => '*/Documentation/Content/*,*/.idea/*,*/.git/*,*/#Trash/*,*/Data/*,*/Library/*,*/3rdParty/*,*/PhpUnit/*,*/jQuery*/*',
			// Don't generate documentation for classes from file or directory with this mask
			//'skipDocPath' => '',
			// Don't generate documentation for classes with this name prefix
			//'skipDocPrefix' => '',
			// Character set of source files
			'charset'      => 'auto',
			// Main project name prefix
			'main'         => 'MOC',
			// Title of generated documentation
			'title'        => '',
			// Documentation base URL
			//'baseUrl' => '',
			// Google Custom Search ID
			//'googleCseId' => '',
			// Google Custom Search label
			//'googleCseLabel' => '',
			// Google Analytics tracking code
			//'googleAnalytics' => '',
			// Template config file
			'templateConfig' =>  __DIR__.'/3rdParty/apigen/templates/MOC/config.neon',
			// Grouping of classes
			'groups'       => 'auto',
			// List of allowed HTML tags in documentation
			'allowedHtml'  => array( 'b', 'i', 'a', 'ul', 'ol', 'li', 'p', 'br', 'var', 'samp', 'kbd', 'tt' ),
			// Element types for search input autocomplete
			'autocomplete' => array( 'classes', 'constants', 'functions' ),
			// Generate documentation for methods and properties with given access level
			'accessLevels' => array( 'public', 'protected', 'private' ),
			// Generate documentation for elements marked as internal and display internal documentation parts
			'internal'     => true,
			// Generate documentation for PHP internal classes
			'php'          => true,
			// Generate tree view of classes, interfaces and exceptions
			'tree'         => true,
			// Generate documentation for deprecated classes, methods, properties and constants
			'deprecated'   => true,
			// Generate documentation of tasks
			'todo'         => true,
			// Generate highlighted source code files
			'sourceCode'   => true,
			// Add a link to download documentation as a ZIP archive
			'download'     => true,
			// Save a checkstyle report of poorly documented elements into a file
			'report'       => '',
			// Wipe out the destination directory first
			'wipeout'      => true,
			// Don't display scanning and generating messages
			'quiet'        => true,
			// Display progressbars
			'progressbar'  => false,
			// Use colors
			'colors'       => false,
			// Check for update
			'updateCheck'  => false,
			// Display additional information in case of an error
			'debug'        => false
		);
	}

	/**
	 * @return bool|null|string
	 */
	public function createDocumentation() {

		set_time_limit( 120 );

		$Config = $this->getConfig();

		$Cache = \MOC\MarkIV\Api::groupCore()->unitCache()->apiFile( 120, __CLASS__ );
		if( !$Cache->getCacheFile( sha1( serialize( $Config ) ) ) ) {
			require_once( __DIR__.'/3rdParty/apigen/libs/Nette/Nette/loader.php' );
			$Neon = new NeonAdapter();
			$Cache->getCacheFile( sha1( serialize( $Config ) ), true )
				->setContent( $Neon->dump( $Config ) )
				->closeFile();
			$_SERVER['argv'] = array(
				'DUMMY-SHELL-ARGS',
				'--config', $Cache->getCacheFile( sha1( serialize( $Config ) ) )->getLocation()
			);

			include( __DIR__.'/3rdParty/apigen/apigen.php' );
		}

		return $this->Destination->getUrl().'/namespace-MOC.MarkIV.Api.html';
	}
}
