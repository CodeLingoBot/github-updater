<?php
/**
 * GitHub Updater
 *
 * @author    Andy Fragen
 * @license   GPL-2.0+
 * @link      https://github.com/afragen/github-updater
 * @package   github-updater
 */

namespace Fragen\GitHub_Updater\API;

use Fragen\GitHub_Updater\API;
use Fragen\GitHub_Updater\Traits\GHU_Trait;

/**
 * Class Language_Pack_API
 */
class Language_Pack_API extends API {
	use GHU_Trait;

	/**
	 * Constructor.
	 *
	 * @param \stdClass $type
	 */
	public function __construct( $type ) {
		parent::__construct();
		self::$method   = 'translation';
		$this->type     = $type;
		$this->response = $this->get_repo_cache();
	}

	/**
	 * Get/process Language Packs.
	 *
	 * @param array $headers Array of headers of Language Pack.
	 *
	 * @return bool When invalid response.
	 */
	public function get_language_pack( $headers ) {
		$response = ! empty( $this->response['languages'] ) ? $this->response['languages'] : false;

		if ( ! $response ) {
			$response = $this->get_language_pack_json( $this->type->git, $headers, $response );

			if ( $response ) {
				foreach ( $response as $locale ) {
					$package = $this->process_language_pack_package( $this->type->git, $locale, $headers );

					$response->{$locale->language}->package = $package;
					$response->{$locale->language}->type    = $this->type->type;
					$response->{$locale->language}->version = $this->type->local_version;
				}

				$this->set_repo_cache( 'languages', $response );
			} else {
				return false;
			}
		}

		$this->type->language_packs = $response;

		return true;
	}

	/**
	 * Get language-pack.json from appropriate host.
	 *
	 * @param string $git     ( github|bitbucket|gitlab|gitea ).
	 * @param array  $headers
	 * @param mixed  $response API response.
	 *
	 * @return array|bool|mixed
	 */
	

	/**
	 * Process $package for update transient.
	 *
	 * @param string $git    ( github|bitbucket|gitlab|gitea ).
	 * @param string $locale
	 * @param array  $headers
	 *
	 * @return array|null|string
	 */
	
}
