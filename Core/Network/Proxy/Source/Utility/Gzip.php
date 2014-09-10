<?php
namespace MOC\MarkIV\Core\Network\Proxy\Source\Utility;

/**
 * Class Gzip
 *
 * @package MOC\MarkIV\Core\Network\Proxy\Source\Utility
 */
class Gzip {

	/**
	 * by katzlbtjunk@hotmail.com
	 * http://de3.php.net/manual/en/function.gzdecode.php#82930
	 *
	 * @param        $Data
	 * @param string $FileName
	 * @param string $Error
	 * @param null   $MaxLength
	 *
	 * @return bool|null|string
	 */
	public static function doDecode( $Data, &$FileName = '', &$Error = '', $MaxLength = null ) {

		$Length = strlen( $Data );
		if( $Length < 18 || strcmp( substr( $Data, 0, 2 ), "\x1f\x8b" ) ) {
			$Error = "Not in GZIP format.";

			return null; // Not GZIP format (See RFC 1952)
		}
		$Method = ord( substr( $Data, 2, 1 ) ); // Compression method
		$Flags = ord( substr( $Data, 3, 1 ) ); // Flags
		if( $Flags & 31 != $Flags ) {
			$Error = "Reserved bits not allowed.";

			return null;
		}
		$HeaderLength = 10;
		if( $Flags & 4 ) {
			// 2-byte length prefixed EXTRA data in header
			if( $Length - $HeaderLength - 2 < 8 ) {
				return false; // invalid
			}
			$ExtraLength = unpack( "v", substr( $Data, 8, 2 ) );
			$ExtraLength = $ExtraLength[1];
			if( $Length - $HeaderLength - 2 - $ExtraLength < 8 ) {
				return false; // invalid
			}
			$HeaderLength += 2 + $ExtraLength;
		}
		$FileName = "";
		if( $Flags & 8 ) {
			// C-style string
			if( $Length - $HeaderLength - 1 < 8 ) {
				return false; // invalid
			}
			$FileNameLength = strpos( substr( $Data, $HeaderLength ), chr( 0 ) );
			if( $FileNameLength === false || $Length - $HeaderLength - $FileNameLength - 1 < 8 ) {
				return false; // invalid
			}
			$FileName = substr( $Data, $HeaderLength, $FileNameLength );
			$HeaderLength += $FileNameLength + 1;
		}
		if( $Flags & 16 ) {
			// C-style string COMMENT data in header
			if( $Length - $HeaderLength - 1 < 8 ) {
				return false; // invalid
			}
			$CommentLength = strpos( substr( $Data, $HeaderLength ), chr( 0 ) );
			if( $CommentLength === false || $Length - $HeaderLength - $CommentLength - 1 < 8 ) {
				return false; // Invalid header format
			}
			$HeaderLength += $CommentLength + 1;
		}
		if( $Flags & 2 ) {
			// 2-bytes (lowest order) of CRC32 on header present
			if( $Length - $HeaderLength - 2 < 8 ) {
				return false; // invalid
			}
			$CalculateCRC = crc32( substr( $Data, 0, $HeaderLength ) ) & 0xffff;
			$HeaderCRC = unpack( "v", substr( $Data, $HeaderLength, 2 ) );
			$HeaderCRC = $HeaderCRC[1];
			if( $HeaderCRC != $CalculateCRC ) {
				$Error = "Header checksum failed.";

				return false; // Bad header CRC
			}
			$HeaderLength += 2;
		}
		// GZIP FOOTER
		$DataCRC = unpack( "V", substr( $Data, -8, 4 ) );
		$DataCRC = sprintf( '%u', $DataCRC[1] & 0xFFFFFFFF );
		$Size = unpack( "V", substr( $Data, -4 ) );
		$Size = $Size[1];

		$BodyLength = $Length - $HeaderLength - 8;
		if( $BodyLength < 1 ) {
			// IMPLEMENTATION BUG!
			return null;
		}
		$Body = substr( $Data, $HeaderLength, $BodyLength );
		$Data = "";
		if( $BodyLength > 0 ) {
			switch( $Method ) {
				case 8:
					// Currently the only supported compression method:
					$Data = gzinflate( $Body, $MaxLength );
					break;
				default:
					$Error = "Unknown compression method.";

					return false;
			}
		} // zero-byte body content is allowed
		// Verify CRC32
		$CRC = sprintf( "%u", crc32( $Data ) );
		$CheckCRC = $CRC == $DataCRC;
		$CheckLength = $Size == strlen( $Data );
		if( !$CheckLength || !$CheckCRC ) {
			$Error = ( $CheckLength ? '' : 'Length check FAILED. ' ).( $CheckCRC ? '' : 'Checksum FAILED.' );

			return false;
		}

		return $Data;
	}
}
