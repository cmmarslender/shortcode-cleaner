<?php

namespace Cmmarslender\ShortcodeCleaner\Admin;

use Cmmarslender\ShortcodeCleaner as SC;

class UI {

	const MENU_SLUG = 'shortcode-cleaner';

	public function setup() {
		add_action( 'admin_menu', [ $this, 'register_menu_item'] );
	}

	public function register_menu_item() {
		$capability = SC\get_plugin( 'capability' );
		add_management_page( __( 'Shortcode Cleaner', 'marslender-shortcode-cleaner' ), __( 'Shortcode Cleaner', 'marslender-shortcode-cleaner' ), $capability, self::MENU_SLUG, [ $this, 'render' ] );
	}

	public function render() {
		$post_types = get_post_types();
		$nonce_action = SC\get_plugin( 'admin.ajax.nonce_action' );
		$nonce_name = SC\get_plugin( 'admin.ajax.nonce_name' );

		include SC\get_plugin( 'DIR' ) . 'templates/admin-ui.php';
	}

}
