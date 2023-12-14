<?php
namespace Getresponse\WordPress;

defined( 'ABSPATH' ) || exit;

/**
 * Class Session
 * @package Getresponse\WordPress
 */
class Session {

	private $prefix = 'gr_';

    /**
	 * @param string $key
	 * @param string $value
	 */
	public function set($key, $value) {

		$_SESSION[$this->prefix.$key] = sanitize_text_field($value);
	}

	/**
	 * @param string $key
	 *
	 * @return string
	 */
	public function get($key) {
		return isset($_SESSION[$this->prefix.$key]) ? sanitize_text_field($_SESSION[$this->prefix.$key]) : null;
	}
}
