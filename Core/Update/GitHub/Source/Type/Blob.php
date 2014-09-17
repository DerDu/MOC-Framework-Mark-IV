<?php
namespace MOC\MarkIV\Core\Update\GitHub\Source\Type;

/**
 * Class Blob
 *
 * @package MOC\MarkIV\Core\Update\GitHub\Source\Type
 */
class Blob
{

    /** @var null|string $Identifier */
    private $Identifier = null;
    /** @var null|int $Size */
    private $Size = null;
    /** @var null|string $Location */
    private $Location = null;

    /**
     * @param \stdClass $Blob
     */
    function __construct( \stdClass $Blob )
    {

        $this->Identifier = $Blob->sha;
        $this->Size = $Blob->size;
        $this->Location = $Blob->path;

    }

    /**
     * @return null|string
     */
    public function getIdentifier()
    {

        return $this->Identifier;
    }

    /**
     * @return int|null
     */
    public function getSize()
    {

        return $this->Size;
    }

    /**
     * @return null|string
     */
    public function getLocation()
    {

        return $this->Location;
    }
}
