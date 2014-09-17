<?php
namespace MOC\MarkIV\Core\Update\GitHub\Source\Type;

use MOC\MarkIV\Core\Update\GitHub\Source\Version;

/**
 * Class Tag
 *
 * @package MOC\MarkIV\Core\Update\GitHub\Source\Type
 */
class Tag
{

    /** @var null|Version $Version */
    private $Version = null;
    /** @var null|string $Identifier */
    private $Identifier = null;

    /**
     * @param \stdClass $Tag
     */
    function __construct( \stdClass $Tag )
    {

        $this->Version = new Version( $Tag->name );
        $this->Identifier = $Tag->commit->sha;
    }

    /**
     * @return null|Version
     */
    public function getVersion()
    {

        return $this->Version;
    }

    /**
     * @return null|string
     */
    public function getIdentifier()
    {

        return $this->Identifier;
    }

}
