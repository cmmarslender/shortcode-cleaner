<?php

namespace Marslender\ShortcodeCleaner;

class Cleaner {

	public function __construct() {

	}

	public function remove_shortcode( $shortcode, $content ) {
		/*
		Order is important here, since if we remove self-closing first, we won't have the opening tag to match on
		enclosing shortcodes
		*/
		$content = $this->remove_enclosing_shortcode( $shortcode, $content );
		$content = $this->remove_self_closing_shortcode( $shortcode, $content );

		return $content;
	}

	public function remove_enclosing_shortcode( $shortcode, $content ) {
		$pattern = sprintf( '@\[%1$s([^\]]*)\](.*)(\[/%1$s\])@i', preg_quote( $shortcode ) );
		$content = preg_replace( $pattern, '$2', $content );

		return $content;
	}

	public function remove_self_closing_shortcode( $shortcode, $content ) {
		$pattern = sprintf( '@\[%1$s([^\]]*)\]@i', preg_quote( $shortcode ) );
		$content = preg_replace( $pattern, '$2', $content );

		return $content;
	}

}
