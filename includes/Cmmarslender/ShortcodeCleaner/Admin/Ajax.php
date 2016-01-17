<?php

namespace Cmmarslender\ShortcodeCleaner\Admin;

use Cmmarslender\ShortcodeCleaner as SC;

class Ajax {

	public $action = 'marslender-sc-clean';

	public $nonce_action = 'clean-shortcode';

	public function setup() {
		add_action( 'wp_ajax_' . $this->action, array( $this, 'handle_ajax' ) );
	}

	public function handle_ajax() {
		if ( ! current_user_can( SC\get_plugin( 'capability' ) ) ) {
			wp_send_json_error( array( 'message' => __( 'You do not have permission to remove shortcodes.', 'marslender-shortcode-cleaner' ) ) );
		}

		if ( ! isset( $_POST[ 'nonce' ] ) || ! wp_verify_nonce( $_POST[ 'nonce' ], $this->nonce_action ) ) {
			wp_send_json_error( array( 'message' => __( 'Unable to verify request. Please try again.', 'marslender-shortcode-cleaner' ) ) );
		}

		if ( ! isset( $_POST['shortcode'] ) || empty( $_POST['shortcode'] ) ) {
			wp_send_json_error( array( 'message' => __( 'You must provide a shortcode name.', 'marslender-shortcode-cleaner' ) ) );
		}

		if ( ! isset( $_POST['post_types'] ) || empty( $_POST['post_types'] ) ) {
			wp_send_json_error( array( 'message' => __( 'You must provide post types to remove shortcodes from.', 'marslender-shortcode-cleaner' ) ) );
		}

		$shortcode = sanitize_text_field( $_POST['shortcode'] );
		$post_types = array_map( 'sanitize_text_field', (array) $_POST['post_types'] );

		// @todo would be nice to integrate multiple post type support to post iterator
		foreach( $post_types as $post_type ) {
			$iterator = new SC\Iterators\Iterator( $shortcode, array( 'post_type' => $post_type ) );
			$iterator->go();
		}

		// @todo i18n
		wp_send_json_success( array( 'message' => "Successfully removed the {$shortcode} shortcode from the selected post types." ) );
	}

}
