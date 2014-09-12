<?php
namespace MOC\MarkIV\Module\Mail\Smtp\Api;

use MOC\MarkIV\Module\Mail\Smtp\Source\Address\Bcc;
use MOC\MarkIV\Module\Mail\Smtp\Source\Address\Cc;
use MOC\MarkIV\Module\Mail\Smtp\Source\Address\From;
use MOC\MarkIV\Module\Mail\Smtp\Source\Address\Reply;
use MOC\MarkIV\Module\Mail\Smtp\Source\Address\To;

/**
 * Class Address
 *
 * @package MOC\MarkIV\Module\Mail\Smtp\Api
 */
class Address {

	/**
	 * @param string $Address
	 * @param string $Name
	 *
	 * @return From
	 */
	public function buildFrom( $Address, $Name = '' ) {

		return new From( $Address, $Name );
	}

	/**
	 * @param string $Address
	 * @param string $Name
	 *
	 * @return Reply
	 */
	public function buildReply( $Address, $Name = '' ) {

		return new Reply( $Address, $Name );

	}

	/**
	 * @param string $Address
	 * @param string $Name
	 *
	 * @return To
	 */
	public function buildTo( $Address, $Name = '' ) {

		return new To( $Address, $Name );
	}

	/**
	 * @param string $Address
	 * @param string $Name
	 *
	 * @return Cc
	 */
	public function buildCc( $Address, $Name = '' ) {

		return new Cc( $Address, $Name );
	}

	/**
	 * @param string $Address
	 * @param string $Name
	 *
	 * @return Bcc
	 */
	public function buildBcc( $Address, $Name = '' ) {

		return new Bcc( $Address, $Name );
	}

}
