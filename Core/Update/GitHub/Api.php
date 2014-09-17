<?php
namespace MOC\MarkIV\Core\Update\GitHub;

use MOC\MarkIV\Core\Update\GitHub\Source\IConfigInterface;

/**
 * Interface IApiInterface
 *
 * @package MOC\MarkIV\Core\Update\GitHub
 */
interface IApiInterface
{

    /**
     * @param null|string $Location
     *
     * @return IConfigInterface
     */
    public function buildConfig( $Location = null );

    /**
     * @param IConfigInterface $Config
     *
     * @return Source\Channel
     */
    public function buildChannel( IConfigInterface $Config );

    /**
     * @param string $String
     *
     * @return Source\Version
     */
    public function buildVersion( $String );
}

/**
 * Class Api
 *
 * @package MOC\MarkIV\Core\Update\GitHub
 */
class Api implements IApiInterface
{

    /**
     * @param null|string $Location
     *
     * @return IConfigInterface
     */
    public function buildConfig( $Location = null )
    {

        if (null === $Location) {
            $Location = __DIR__.'/Config.ini';
        }

        return new Source\Config( $Location );
    }

    /**
     * @param IConfigInterface $Config
     *
     * @return Source\Channel
     */
    public function buildChannel( IConfigInterface $Config )
    {

        return new Source\Channel( $Config );
    }

    /**
     * @param string $String
     *
     * @return Source\Version
     */
    public function buildVersion( $String )
    {

        return new Source\Version( $String );
    }

}
