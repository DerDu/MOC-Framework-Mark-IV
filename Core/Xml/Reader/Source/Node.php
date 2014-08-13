<?php
namespace MOC\IV\Core\Xml\Reader\Source;

class Node extends NodeType {

	/** @var null|int $Position */
	private $Position = null;
	/** @var null|Node $Parent */
	private $Parent = null;
	/** @var Node[] $ChildList */
	private $ChildList = array();

	private $Name = null;
	private $Content = null;
	private $AttributeList = array();

	function __construct( Token $Token ) {

		$this->Name = $Token->getName();
		$this->AttributeList = $Token->getAttributeList();
		$this->Position = $Token->getPosition();
		unset( $Token );

		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getPosition() {
		return $this->Position;
	}

	/**
	 * @param Node $Value
	 *
	 * @return Node
	 */
	public function setParent( Node $Value ) {
		$this->Parent = $Value;
		return $this;
	}

	/**
	 * @return null|Node
	 */
	public function getParent() {
		return $this->Parent;
	}

	/**
	 * @param      $Name
	 * @param null $AttributeList
	 * @param null $Index
	 * @param bool $Recursive
	 * @param bool $NameIsRegExp
	 *
	 * @return bool|Node
	 */
	public function getChild( $Name, $AttributeList = null, $Index = null, $Recursive = true, $NameIsRegExp = false ) {
		/** @var Node $Node */
		foreach( $this->ChildList as $Node ) {
			if( $Node->getName() == $Name || ( $NameIsRegExp && preg_match( $Name, $Node->getName() ) ) ) {
				if( $AttributeList === null && $Index === null ) {
					return $Node;
				} else if( $Index === null ) {
					if( $Node->getAttributeList() == $AttributeList ) {
						return $Node;
					}
				} else if( $AttributeList === null ) {
					if( $Index === 0 ) {
						return $Node;
					} else {
						$Index--;
					}
				} else {
					if( $Node->getAttributeList() == $AttributeList && $Index === 0 ) {
						return $Node;
					} else if( $Node->getAttributeList() == $AttributeList ) {
						$Index--;
					}
				}
			}
			if( true === $Recursive && !empty( $Node->ChildList ) ) {
				if( false !== ( $Result = $Node->getChild( $Name, $AttributeList, $Index, $Recursive, $NameIsRegExp ) ) ) {
					if( !is_object( $Result ) ) {
						$Index = $Result;
					} else {
						return $Result;
					}
				}
			}
		}
		if( $Index !== null ) {
			return $Index;
		} else {
			return false;
		}
	}

	/**
	 * @return int
	 */
	public function getChildListCount() {
		return count( $this->getChildList() );
	}

	/**
	 * @return Node[]
	 */
	public function getChildList() {
		return $this->ChildList;
	}

	/**
	 * @param Node $Node
	 * @param null|Node $After
	 *
	 * @return Node
	 */
	public function addChild( Node $Node, Node $After = null ) {
		if( $After === null ) {
			$Node->setParent( $this );
			array_push( $this->ChildList, $Node );
			$this->Content = null;
			$this->setType( self::TYPE_STRUCTURE );
		} else {
			$this->injectChild( $Node, $After );
		}
		return $this;
	}

	private function injectChild( Node $Inject, Node $After ) {
		$Index = array_search( $After, $this->ChildList ) +1;
		$Left = array_slice( $this->ChildList, 0, $Index, true );
		$Right = array_slice( $this->ChildList, $Index, null, true );
		$this->setChildList( array_merge( $Left, array( $Inject ), $Right ) );
	}

	/**
	 * @param Node[] $NodeList
	 *
	 * @return Node
	 */
	public function setChildList( $NodeList ) {
		$this->ChildList = array();
		foreach( $NodeList as $Node ) {
			$this->addChild( $Node );
		}
		return $this;
	}

	/**
	 * @return null
	 */
	public function getName() {
		return $this->Name;
	}

	/**
	 * @param $Value
	 *
	 * @return Node
	 */
	public function setName( $Value ) {
		$this->Name = $Value;
		return $this;
	}

	/**
	 * @return null
	 */
	public function getContent() {
		return $this->Content;
	}

	/**
	 * @param null $Value
	 *
	 * @return Node
	 */
	public function setContent( $Value = null ) {
		if( preg_match( '![<>&]!is', $Value ) ) {
			$this->setType( self::TYPE_CDATA );
		} else {
			$this->setType( self::TYPE_CONTENT );
		}
		if( strlen( $Value ) == 0 ) {
			$this->Content = null;
		} else {
			$this->Content = $Value;
		}
		$this->ChildList = array();
		return $this;
	}

	/**
	 * @param $Name
	 *
	 * @return null
	 */
	public function getAttribute( $Name ) {
		if( isset( $this->AttributeList[$Name] ) ) {
			return $this->AttributeList[$Name];
		} else {
			return null;
		}
	}

	/**
	 * @return array
	 */
	public function getAttributeList() {
		return $this->AttributeList;
	}

	/**
	 * @return string
	 */
	public function getAttributeString() {
		$AttributeList = $this->AttributeList;
		array_walk( $AttributeList, create_function( '&$Value,$Key', '$Value = $Key.\'="\'.$Value.\'"\';' ) );
		return implode(' ',$AttributeList);
	}

	public function __destruct() {
		/** @var Node $Node */
		unset( $this->Parent );
		foreach( (array)$this->ChildList as $Node ) {
			$Node->__destruct();
		}
		unset( $this );
	}
}
