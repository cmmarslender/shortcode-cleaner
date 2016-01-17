<?php

namespace Cmmarslender\ShortcodeCleaner;

use Cmmarslender\ShortcodeCleaner\Iterators\Iterator;

class IteratorTest extends \WP_UnitTestCase {

	public function test_iterator_processes_post_correctly() {
		$content_before = 'This is some content with a [shortcode] with nested shortcodes[shortcode] and a closing tag[/shortcode]';
		$content_expected = 'This is some content with a  with nested shortcodes and a closing tag';

		$post = new \WP_Post( new \stdClass() );
		$post->post_content = $content_before;

		$iterator = new Iterator( 'shortcode' );

		// Manually set the post object, so we don't need a DB to run the tests
		$iterator->current_post_object = $post;

		$iterator->process_post();

		$this->assertEquals(
			$content_expected,
			$iterator->current_post_object->post_content
		);
	}

}
