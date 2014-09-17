<?php
namespace MOC\MarkIV\Core\Update\GitHub\Source\Utility;

/**
 * Class Ini
 *
 * @package MOC\MarkIV\Core\Update\GitHub\Source\Utility
 */
class Ini
{

    /**
     * @param string $Location
     * @param int    $Scanner INI_SCANNER_NORMAL, INI_SCANNER_RAW
     *
     * @return array
     */
    public static function readFile( $Location, $Scanner = INI_SCANNER_NORMAL )
    {

        return parse_ini_file( $Location, true, $Scanner );
    }

    /**
     * @param string $Location
     * @param array  $Array
     *
     * @return bool
     */
    public static function writeFile( $Location, $Array )
    {

        $Content = '';
        if (!$Location = fopen( $Location, 'w' )) {
            return false;
        }
        self::doWrite( $Content, $Array, true );
        if (!fwrite( $Location, $Content )) {
            return false;
        }
        fclose( $Location );

        return true;
    }

    /**
     * @param string $Content
     * @param array  $Array
     * @param bool   $Sections
     */
    private static function doWrite( &$Content, $Array, $Sections )
    {

        foreach ($Array as $Key => $Value) {
            if (is_array( $Value )) {
                if ($Sections) {
                    $Content .= "[$Key]\n";
                    self::doWrite( $Content, $Value, false );
                } else {
                    foreach ($Value as $iKey => $iVal) {
                        if (is_int( $iKey )) {
                            $Content .= $Key."[] = $iVal\n";
                        } else {
                            $Content .= $Key."[$iKey] = $iVal\n";
                        }
                    }
                }
            } else {
                $Content .= "$Key = $Value\n";
            }
        }
    }
}
