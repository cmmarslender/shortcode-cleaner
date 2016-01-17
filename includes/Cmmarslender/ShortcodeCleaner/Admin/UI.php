<?php

namespace Cmmarslender\ShortcodeCleaner\Admin;

use Cmmarslender\ShortcodeCleaner as SC;

class UI {

	const MENU_SLUG = 'shortcode-cleaner';

	public function setup() {
		add_action( 'admin_menu', [ $this, 'register_menu_item'] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	public function register_menu_item() {
		$capability = SC\get_plugin( 'capability' );
		add_management_page( __( 'Shortcode Cleaner', 'marslender-shortcode-cleaner' ), __( 'Shortcode Cleaner', 'marslender-shortcode-cleaner' ), $capability, self::MENU_SLUG, [ $this, 'render' ] );
	}

	public function enqueue_scripts( $page ) {
		if ( 'tools_page_' . self::MENU_SLUG != $page ) {
			return;
		}

		wp_enqueue_script( 'shortcode-cleaner' );
		wp_localize_script( 'shortcode-cleaner', 'ShortcodeCleaner', [
			'nonce' => wp_create_nonce( SC\get_plugin( 'admin.ajax.nonce_action' ) ),
			'action' => SC\get_plugin( 'admin.ajax.action' )
		] );
	}

	public function render() {
		$post_types = get_post_types();

		include SC\get_plugin( 'DIR' ) . 'templates/admin-ui.php';
	}

}
