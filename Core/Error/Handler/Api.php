<?php
namespace MOC\MarkIV\Core\Error\Handler;

use MOC\MarkIV\Core\Error\Handler\Api\Type;
use MOC\MarkIV\Core\Error\Handler\Source\Type\Generic;

/**
 * Interface IApiInterface
 *
 * @package MOC\MarkIV\Core\Error\Handler
 */
interface IApiInterface
{

    /**
     * @return Type
     */
    public function apiType();

    /**
     * @param Generic $Type
     *
     * @return Api
     */
    public function registerType( Generic $Type );

    /**
     * @param bool $Toggle
     *
     * @return IApiInterface
     */
    public function applyTemplate( $Toggle = true );
}

/**
 * Class Api
 *
 * @package MOC\MarkIV\Core\Error\Handler
 */
class Api implements IApiInterface
{

    /**
     * @return Type
     */
    public function apiType()
    {

        return new Type();
    }

    /**
     * @param Generic $Type
     *
     * @return IApiInterface
     */
    public function registerType( Generic $Type )
    {

        $Type->registerType();

        return $this;
    }

    /**
     * @param bool $Toggle
     *
     * @return IApiInterface
     */
    public function applyTemplate( $Toggle = true )
    {

        Source\Template\Generic::$ApplyTemplate = $Toggle;
        return $this;
    }
}
