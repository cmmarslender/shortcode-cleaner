<?php

namespace Cmmarslender\ShortcodeCleaner;

class Plugin {

	/**
	 * Path to the main plugin file
	 *
	 * @var string
	 */
	public $FILE;

	/**
	 * Path to the main plugin directory
	 *
	 * @var string
	 */
	public $DIR;

	/**
	 * URL to the main plugin directory
	 *
	 * @var string
	 */
	public $URL;

	/**
	 * Current plugin version
	 *
	 * @var string
	 */
	public $version;

	/**
	 * The capability required to remove shortcodes
	 *
	 * @var string
	 */
	public $capability;

	/**
	 * @var \Cmmarslender\ShortcodeCleaner\Cleaner
	 */
	public $cleaner;

	/**
	 * @var \Cmmarslender\ShortcodeCleaner\Admin
	 */
	public $admin;

	public function setup( $plugin_file ) {
		$this->FILE = $plugin_file;
		$this->DIR = trailingslashit( dirname( $plugin_file ) );
		$this->URL = trailingslashit( plugin_dir_url( $plugin_file ) );
		$this->version = "1.0.0";
		$this->capability = apply_filters( 'marslender-shortcode-cleaner-menu-capability', 'edit_others_posts' );

		add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ), 5 );

		$this->cleaner = new Cleaner();

		$this->admin = new Admin();
		$this->admin->setup();
	}

	public function register_scripts() {
		$extension = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '.js' : '.min.js';

		wp_register_script( 'shortcode-cleaner', $this->URL . 'assets/js/main' . $extension, array( 'jquery' ), $this->version, true );
	}

}
