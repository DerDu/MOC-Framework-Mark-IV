<?php
namespace MOC\IV\Core\Update\GitHub;

/**
 * Interface IApiInterface
 *
 * @package MOC\IV\Core\Update\GitHub
 */
interface IApiInterface {
	/**
	 * @param $Location
	 *
	 * @return Source\Config
	 */
	public function buildConfig( $Location );

	/**
	 * @param Source\Config $Config
	 *
	 * @return Source\Channel
	 */
	public function buildChannel( Source\Config $Config );

	/**
	 * @param $String
	 *
	 * @return Source\Version
	 */
	public function buildVersion( $String );
}

/**
 * Class Api
 *
 * @package MOC\IV\Core\Update\GitHub
 */
class Api implements IApiInterface {

	/**
	 * @param $Location
	 *
	 * @return Source\Config
	 */
	public function buildConfig( $Location ) {

		return new Source\Config( $Location );
	}

	/**
	 * @param Source\Config $Config
	 *
	 * @return Source\Channel
	 */
	public function buildChannel( Source\Config $Config ) {

		return new Source\Channel( $Config );
	}

	/**
	 * @param $String
	 *
	 * @return Source\Version
	 */
	public function buildVersion( $String ) {

		return new Source\Version( $String );
	}

}
