<?php
namespace MOC\IV\Core\Xml\Reader\Source;

class Parser extends Mask {

	/** @var array $Stack */
	private $Stack = array();
	/** @var null|Node $Result */
	private $Result = null;

	function __construct( Tokenizer $Tokenizer ) {
		/** @var Token $Token */
		foreach( (array)$Tokenizer->getResult() as $Token ) {
			// Convert Token to Node
			$Node = new Node( $Token );
			// Handle Token by Type
			if( $Token->isOpenTag() ) {
				// Set Parent Type to Structure
				if( !empty( $this->Stack ) ) {
					$Parent = array_pop( $this->Stack );
					$Parent->setType( $Parent::TYPE_STRUCTURE );
					array_push( $this->Stack, $Parent );
				}
				// Add Node to Stack
				array_push( $this->Stack, $Node );
			} elseif( $Token->isCloseTag() ) {
				// Get Parent (OpenTag)
				/** @var Node $Parent */
				$Parent = array_pop( $this->Stack );
				// Handle Close by Type
				switch( $Parent->getType() ) {
					case $Parent::TYPE_CONTENT : {
						// Get Content
						$LengthName = strlen( $Parent->getName() ) +1;
						$LengthAttribute = strlen( $Parent->getAttributeString() ) +1;
						$LengthAttribute = ( $LengthAttribute == 1 ? 0 : $LengthAttribute );
						$Parent->setContent(
							substr(
								$Tokenizer->getContent(),

								$Parent->getPosition()
									+ $LengthName
									+ $LengthAttribute,

								( $Token->getPosition() - $Parent->getPosition() )
									- ( $LengthName +1 )
									- ( $LengthAttribute )
							)
						);
						// Do Parent Close
						$Ancestor = array_pop( $this->Stack );
						$Ancestor->addChild( $Parent );
						array_push( $this->Stack, $Ancestor );
						break;
					}
					case $Parent::TYPE_STRUCTURE : {
						// Set Ancestor <-> Parent Relation
						/** @var Node $Ancestor */
						$Ancestor = array_pop( $this->Stack );
						if( is_object( $Ancestor ) ) {
							// Do Parent Close
							$Ancestor->addChild( $Parent );
							array_push( $this->Stack, $Ancestor );
						} else {
							// No Ancestor -> Parent = Root
							array_push( $this->Stack, $Parent );
						}
						break;
					}
					case $Parent::TYPE_CDATA : {
						// Set Ancestor <-> Parent Relation
						/** @var Node $Ancestor */
						$Ancestor = array_pop( $this->Stack );
						// Do Parent Close
						$Ancestor->addChild( $Parent );
						array_push( $this->Stack, $Ancestor );
						break;
					}
				}
			} elseif( $Token->isShortTag() ) {
				// Set Ancestor <-> Node Relation
				/** @var Node $Parent */
				$Ancestor = array_pop( $this->Stack );
				$Ancestor->setType( $Ancestor::TYPE_STRUCTURE );
				// Do Node Close
				$Ancestor->addChild( $Node );
				array_push( $this->Stack, $Ancestor );
			} elseif( $Token->isCDATATag() ) {
				// Set Parent Type/Content
				/** @var Node $Parent */
				$Parent = array_pop( $this->Stack );
				$Parent->setType( $Parent::TYPE_CDATA );
				$Parent->setContent( $Node->getName() );
				$this->decodePayload( $Parent, self::MASK_CDATA );
				// Do Node Close
				array_push( $this->Stack, $Parent );
			} elseif( $Token->isCommentTag() ) {
				// Set Parent Type/Content
				/** @var Node $Parent */
				$Parent = array_pop( $this->Stack );
				$Node->setType( $Node::TYPE_COMMENT );
				$Node->setContent( $Node->getName() );
				$Node->setName( '__COMMENT__' );
				$this->decodePayload( $Node, self::MASK_COMMENT );
				// Do Node Close
				$Parent->addChild( $Node );
				array_push( $this->Stack, $Parent );
			}
		}
		// Set parsed Stack as Result
		$this->Result = array_pop( $this->Stack );
	}

	/**
	 * @return Node|null
	 */
	public function getResult() {
		return $this->Result;
	}
}
