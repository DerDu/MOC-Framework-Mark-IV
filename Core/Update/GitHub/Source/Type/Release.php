<?php
namespace MOC\MarkIV\Core\Update\GitHub\Source\Type;

use MOC\MarkIV\Core\Update\GitHub\Source\Version;

/**
 * Class Release
 *
 * @package MOC\MarkIV\Core\Update\GitHub\Source\Type
 */
class Release
{

    /** @var null|string $Name */
    private $Name = null;
    /** @var null|string $Description */
    private $Description = null;
    /** @var null|Version $Version */
    private $Version = null;
    /** @var null|Tag $Tag */
    private $Tag = null;
    /** @var null|Tree $Tree */
    private $Tree = null;
    /** @var array|Data[] $Data */
    private $DataList = array();

    /**
     * @param \stdClass $Release
     */
    function __construct( \stdClass $Release )
    {

        if (isset( $Release->tag_name )) {
            $this->Name = $Release->name;
            $this->Description = $Release->body;
            $this->Version = new Version( $Release->tag_name );
        } else {
            $this->Name = '';
            $this->Description = '';
            $this->Version = new Version( $Release->name );
        }

    }

    /**
     * @return null|string
     */
    public function getName()
    {

        return $this->Name;
    }

    /**
     * @return null|string
     */
    public function getDescription()
    {

        return $this->Description;
    }

    /**
     * @return null|Version
     */
    public function getVersion()
    {

        return $this->Version;
    }

    /**
     * @return Tag|null
     */
    public function getTag()
    {

        return $this->Tag;
    }

    /**
     * @param Tag $Tag
     */
    public function setTag( Tag $Tag )
    {

        $this->Tag = $Tag;
    }

    /**
     * @return Tree|null
     */
    public function getTree()
    {

        return $this->Tree;
    }

    /**
     * @param Tree $Tree
     */
    public function setTree( Tree $Tree )
    {

        $this->Tree = $Tree;
    }

    /**
     * @return array|Data[]
     */
    public function getDataList()
    {

        return $this->DataList;
    }

    /**
     * @param Data[] $DataList
     */
    public function setDataList( $DataList )
    {

        $this->DataList = $DataList;
    }
}
