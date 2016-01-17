<?php

namespace Cmmarslender\ShortcodeCleaner\Iterators;

use Cmmarslender\PostIterator\PostIterator;

class Iterator extends PostIterator {

	/**
	 * The shortcode that we're removing from the posts
	 *
	 * @var string
	 */
	public $shortcode;

	public function __construct( $shortcode, $parent_args = array() ) {
		$this->shortcode = $shortcode;
		parent::__construct( $parent_args );
	}

	public function process_post() {
		$cleaner = get_plugin( 'cleaner' );

		$this->current_post_object->post_content = $cleaner->remove_shortcode( $this->shortcode, $this->current_post_object->post_content );

		$this->update_post();
	}

}
