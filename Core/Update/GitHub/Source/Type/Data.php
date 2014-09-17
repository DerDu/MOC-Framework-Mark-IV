<?php
namespace MOC\MarkIV\Core\Update\GitHub\Source\Type;

/**
 * Class Data
 *
 * @package MOC\MarkIV\Core\Update\GitHub\Source\Type
 */
class Data
{

    /** @var null|string $Identifier */
    private $Identifier = null;
    /** @var null|int $Size */
    private $Size = null;
    /** @var null|string $Content */
    private $Content = null;

    /**
     * @param \stdClass $Data
     */
    function __construct( \stdClass $Data )
    {

        $this->Identifier = $Data->sha;
        $this->Size = $Data->size;
        $Decoder = $Data->encoding.'_decode';
        $this->Content = $Decoder( $Data->content );

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
    public function getContent()
    {

        return $this->Content;
    }
}
