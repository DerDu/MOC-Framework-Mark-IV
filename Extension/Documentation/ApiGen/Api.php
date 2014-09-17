<?php
namespace MOC\MarkIV\Extension\Documentation\ApiGen;

use MOC\MarkIV\Extension\Documentation\IApiInterface;
use Nette\Config\Adapters\NeonAdapter;

/**
 * Class Api
 *
 * @package MOC\MarkIV\Extension\Documentation\ApiGen
 */
class Api implements IApiInterface
{

    /** @var \MOC\MarkIV\Core\Drive\Directory\IApiInterface|null $Source */
    private $Source = null;
    /** @var \MOC\MarkIV\Core\Drive\Directory\IApiInterface|null $Destination */
    private $Destination = null;
    /** @var array $Configuration */
    private $Configuration = array();

    /**
     * @param \MOC\MarkIV\Core\Drive\Directory\IApiInterface $Source
     * @param \MOC\MarkIV\Core\Drive\Directory\IApiInterface $Destination
     */
    function __construct(
        \MOC\MarkIV\Core\Drive\Directory\IApiInterface $Source,
        \MOC\MarkIV\Core\Drive\Directory\IApiInterface $Destination
    ) {

        \MOC\MarkIV\Api::registerNamespace(
            'ApiGen', \MOC\MarkIV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/3rdParty' )
        );
        \MOC\MarkIV\Api::registerNamespace(
            'TokenReflection',
            \MOC\MarkIV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/3rdParty/libs/TokenReflection' )
        );
        \MOC\MarkIV\Api::registerNamespace(
            'FSHL', \MOC\MarkIV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/3rdParty/libs/FSHL' )
        );

        $this->Source = $Source;
        $this->Destination = $Destination;
        $this->Configuration = $this->getConfig();
    }

    private function getConfig()
    {

        return array(
            // Source file or directory to parse
            'source'         => $this->Source->getLocation(),
            // Directory where to save the generated documentation
            'destination'    => $this->Destination->getLocation(),
            // List of allowed file extensions
            'extensions'     => array( 'php' ),
            // Mask to exclude file or directory from processing
            'exclude'        => '*/Documentation/Content/*,*/.idea/*,*/.git/*,*/#Trash/*,*/Data/*,*/Library/*,*/3rdParty/*,*/PhpUnit/*,*/jQuery*/*',
            // Don't generate documentation for classes from file or directory with this mask
            //'skipDocPath' => '',
            // Don't generate documentation for classes with this name prefix
            //'skipDocPrefix' => '',
            // Character set of source files
            'charset'        => 'auto',
            // Main project name prefix
            'main'           => 'MOC',
            // Title of generated documentation
            'title'          => '',
            // Documentation base URL
            //'baseUrl' => '',
            // Google Custom Search ID
            //'googleCseId' => '',
            // Google Custom Search label
            //'googleCseLabel' => '',
            // Google Analytics tracking code
            //'googleAnalytics' => '',
            // Template config file
            'templateConfig' => __DIR__.'/Gui/Template/config.neon',
            // Grouping of classes
            'groups'         => 'auto',
            // List of allowed HTML tags in documentation
            'allowedHtml'    => array( 'b', 'i', 'a', 'ul', 'ol', 'li', 'p', 'br', 'var', 'samp', 'kbd', 'tt' ),
            // Element types for search input autocomplete
            'autocomplete'   => array( 'classes', 'constants', 'functions' ),
            // Generate documentation for methods and properties with given access level
            'accessLevels'   => array( 'public', 'protected', 'private' ),
            // Generate documentation for elements marked as internal and display internal documentation parts
            'internal'       => true,
            // Generate documentation for PHP internal classes
            'php'            => true,
            // Generate tree view of classes, interfaces and exceptions
            'tree'           => true,
            // Generate documentation for deprecated classes, methods, properties and constants
            'deprecated'     => true,
            // Generate documentation of tasks
            'todo'           => true,
            // Generate highlighted source code files
            'sourceCode'     => true,
            // Add a link to download documentation as a ZIP archive
            'download'       => true,
            // Save a check style report of poorly documented elements into a file
            'report'         => '',
            // Wipe out the destination directory first
            'wipeout'        => true,
            // Don't display scanning and generating messages
            'quiet'          => true,
            // Display progressbar
            'progressbar'    => false,
            // Use colors
            'colors'         => false,
            // Check for update
            'updateCheck'    => false,
            // Display additional information in case of an error
            'debug'          => false
        );
    }

    /**
     * @codeCoverageIgnore
     * @return bool|null|string
     */
    public function createDocumentation()
    {

        set_time_limit( 0 );

        $Config = $this->getConfig();

        $Cache = \MOC\MarkIV\Api::groupCore()->unitCache()->apiFile( 30, __CLASS__ );
        if (( isset( $_REQUEST['Force'] ) && $_REQUEST['Force'] ) || !$Cache->getCacheFile( sha1( serialize( $Config ) ) )) {
            require_once( __DIR__.'/3rdParty/libs/Nette/Nette/loader.php' );
            $Neon = new NeonAdapter();
            $Cache->getCacheFile( sha1( serialize( $Config ) ), true )
                ->setContent( $Neon->dump( $Config ) )
                ->closeFile();
            $_SERVER['argv'] = array(
                'DUMMY-SHELL-ARGS',
                '--config',
                $Cache->getCacheFile( sha1( serialize( $Config ) ) )->getLocation()
            );

            include( __DIR__.'/3rdParty/apigen.php' );
        }

        return $this->Destination->getUrl().'/namespace-MOC.MarkIV.Api.html';
    }
}
