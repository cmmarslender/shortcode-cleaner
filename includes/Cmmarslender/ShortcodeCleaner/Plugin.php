<?php

namespace Cmmarslender\ShortcodeCleaner;

class Plugin {

	/**
	 * Path to the main plugin directory
	 *
	 * @var string
	 */
	public $DIR;

	/**
	 * Path to the main plugin file
	 *
	 * @var string
	 */
	public $FILE;

	/**
	 * The capability required to remove shortcodes
	 *
	 * @var string
	 */
	public $capability;

	/**
	 * @var \Marslender\ShortcodeCleaner\Cleaner
	 */
	public $cleaner;

	public function setup( $plugin_file ) {
		$this->FILE = $plugin_file;
		$this->DIR = trailingslashit( dirname( $plugin_file ) );
		$this->capability = apply_filters( 'marslender-shortcode-cleaner-menu-capability', 'edit_others_posts' );

		$this->cleaner = new Cleaner();
	}

}
