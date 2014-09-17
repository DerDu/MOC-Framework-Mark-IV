<?php
namespace MOC\MarkIV\Core\Error\Handler\Source\Type;

use MOC\MarkIV\Core\Error\Handler\Source\Template\Error as ErrorTemplate;

/**
 * Interface IGenericInterface
 *
 * @package MOC\MarkIV\Core\Error\Handler\Source\Type
 */
interface IGenericInterface
{

    public function registerType();

    /**
     * @param string $Title
     * @param string $Message
     * @param string $Code
     * @param string $File
     * @param string $Line
     * @param string $Trace
     * @param string $Information
     *
     * @return void
     */
    public function setData( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' );
}

/**
 * Class Generic
 *
 * @package MOC\MarkIV\Core\Error\Handler\Source\Type
 */
abstract class Generic implements IGenericInterface
{

    /**
     * @param string $Title
     * @param string $Message
     * @param string $Code
     * @param string $File
     * @param string $Line
     * @param string $Trace
     * @param string $Information
     *
     * @return void
     */
    public function setData( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' )
    {

        if (empty( $Trace )) {
            $Trace = $this->getTrace();
        }
        print new ErrorTemplate( $Title, $Message, $Code, $File, $Line, $Trace, $Information );
    }

    /**
     * @return string
     */
    protected function getTrace()
    {

        $Exception = new \Exception();
        $Trace = explode( "\n", trim( $this->getExceptionTraceAsString( $Exception ) ) );
        $Length = count( $Trace );
        $Result = array();
        for ($Run = 0; $Run < $Length; $Run++) {
            $Result[] = substr( $Trace[$Run], strpos( $Trace[$Run], ' ' ) );
        }

        return '<ul><li>'.implode( '</li><li>', $Result ).'</li></ul>';
    }

    /**
     * @param \Exception $Exception
     *
     * @return string
     */
    private function getExceptionTraceAsString( \Exception $Exception )
    {

        $Return = "";
        $Count = 0;
        foreach ($Exception->getTrace() as $Frame) {
            $ArgumentList = "";
            if (isset( $Frame['args'] )) {
                $ArgumentList = array();
                foreach ($Frame['args'] as $Argument) {
                    if (is_string( $Argument )) {
                        $ArgumentList[] = "'".$Argument."'";
                    } elseif (is_array( $Argument )) {
                        $ArgumentList[] = "Array";
                    } elseif (is_null( $Argument )) {
                        $ArgumentList[] = 'NULL';
                    } elseif (is_bool( $Argument )) {
                        $ArgumentList[] = ( $Argument ) ? "true" : "false";
                    } elseif (is_object( $Argument )) {
                        $ArgumentList[] = get_class( $Argument );
                    } elseif (is_resource( $Argument )) {
                        $ArgumentList[] = get_resource_type( $Argument );
                    } else {
                        $ArgumentList[] = $Argument;
                    }
                }
                $ArgumentList = join( ", ", $ArgumentList );
            }
            $Return .= sprintf( "#%s %s(%s): %s(%s)\n",
                $Count,
                isset( $Frame['file'] ) ? $Frame['file'] : 'unknown file',
                isset( $Frame['line'] ) ? $Frame['line'] : 'unknown line',
                ( isset( $Frame['class'] ) ) ? $Frame['class'].$Frame['type'].$Frame['function'] : $Frame['function'],
                $ArgumentList );
            $Count++;
        }
        return $Return;
    }
}
