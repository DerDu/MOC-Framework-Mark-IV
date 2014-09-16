<?php
namespace MOC\MarkIV\Plugin\OSMEngine\Utility;

use MOC\MarkIV\Plugin\OSMEngine\Utility;

/**
 * Class Converter
 *
 * @package MOC\MarkIV\Plugin\OSMEngine\Utility
 */
class Converter {

	private $South, $North, $West, $East;
	private $Width, $Height;
	private $MinY, $MaxY;
	private $FactorX, $FactorY;

	// This map would show Germany:
	function __construct( $South = 47.2, $North = 55.2, $West = 5.8, $East = 15.2, $Width = 1000, $Height = 1500 ) {

		$this->South = deg2rad( $South );
		$this->North = deg2rad( $North );
		$this->West = deg2rad( $West );
		$this->East = deg2rad( $East );

		$this->setSize( $Width, $Height );
	}

	public function setSize( $Width, $Height, $keepAspect = false ) {

		// This also controls the aspect ratio of the projection
		$this->Width = $Width;
		$this->Height = $Height;

		// Corrent Ratio
		if( $keepAspect ) {
			$Y = abs( $this->South - $this->North );
			$X = abs( $this->West - $this->East );
			$this->Height = $this->Width / $X * $Y;
		}

		// Some constants to relate chosen area to screen coordinates
		$this->MinY = $this->mercatorY( $this->South );
		$this->MaxY = $this->mercatorY( $this->North );
		$this->FactorX = $this->Width / ( $this->East - $this->West );
		$this->FactorY = $this->Height / ( $this->MaxY - $this->MinY );
	}

	// Formula for mercator projection y coordinate:

	private function mercatorY( $Latitude ) {

		return log( tan( $Latitude / 2 + M_PI / 4 ) );
	}

	public static function setupMap( $South = 47.2, $North = 55.2, $West = 5.8, $East = 15.2, $Width = 1000, $Height = 1500 ) {

		return new Converter( $South, $North, $West, $East, $Width, $Height );
	}

	public function getSize() {

		return new Utility\Converter\Position( $this->Width, $this->Height );
	}

	// both in radians, use deg2rad if neccessary
	public function toPixel( $Latitude, $Longitude ) {

		$x = deg2rad( $Longitude );
		$y = $this->mercatorY( deg2rad( $Latitude ) );
		$x = ( $x - $this->West ) * $this->FactorX;
		// y points south
		$y = ( $this->MaxY - $y ) * $this->FactorY;

		return new Utility\Converter\Position( $x, $y );
	}
}

/*
$pts = array( // Source: Wikipedia
 "Berlin",   52, 31, 13, 24,
 "Hamburg",  53, 33, 10, 00,
 "Muenchen", 48, 08, 11, 35,
 "Koelln",   50, 56, 06, 57,
);

for ($i = 0; $i != count($pts); $i += 5) {
  $name = $pts[$i];
  $lat = deg2rad($pts[$i + 1] + $pts[$i + 2]/60);
  $lon = deg2rad($pts[$i + 3] + $pts[$i + 4]/60);
  $res = mapProject($lat, $lon);
  $x = $res[0];
  $y = $res[1];
  print("$name: $x, $y\n");
}
*/
