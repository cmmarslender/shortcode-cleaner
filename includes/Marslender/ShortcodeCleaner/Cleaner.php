<?php

namespace Marslender\ShortcodeCleaner;

class Cleaner {

	public function __construct() {

	}

	public function remove_shortcode( $shortcode, $content ) {
		$pattern = sprintf( '@\[%1$s([^\]]*)\]([^\[]*)(\[/%1$s\])?@i', preg_quote( $shortcode ) );
		$content = preg_replace( $pattern, '$2', $content );

		return $content;
	}

}
