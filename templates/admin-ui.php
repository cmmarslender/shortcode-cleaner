<div class="wrap">
	<h1>Shortcode Cleaner</h1>

	<form method="POST" id="shortcode-cleaner-form">
		<h3><?php esc_html_e( 'What shortcode would you like to remove from the selected post types?', 'marslender-shortcode-cleaner' ); ?></h3>
		<p>
			<label for="shortcode"><?php esc_html_e( 'Shortcode', 'marslender-shortcode-cleaner' ); ?></label>
			<input type="text" name="shortcode" id="shortcode">
		</p>

		<h3><?php esc_html_e( 'Which post types would you like to clean?', 'marslender-shortcode-cleaner' ); ?></h3>
		<?php
		// @todo would be nice to use a selectize style multiselect here
		foreach ( $post_types as $post_type ) {
			?>
			<p>
				<input type="checkbox" name="post_types[]" value="<?php echo esc_attr( $post_type ); ?>" id="post_type_<?php echo esc_attr( $post_type ); ?>">
				<label for="post_type_<?php echo esc_attr( $post_type ); ?>"><?php echo esc_html( $post_type ); ?></label>
			</p>
			<?php
		}
		?>

		<?php
		submit_button( __( 'Clean Shortcodes', 'marslender-shortcode-cleaner' ), 'primary', 'submit', true, [ 'id' => 'shortcode-submit' ] );
		?>
	</form>
</div>