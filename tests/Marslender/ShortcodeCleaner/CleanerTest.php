<?php

use Marslender\ShortcodeCleaner as SC;

class CleanerTest extends WP_UnitTestCase {

	function test_self_closing_shortcode() {
		$before = 'This is some content with a [shortcode] inside of it';
		$after = 'This is some content with a  inside of it';

		$cleaner = \Marslender\ShortcodeCleaner\get_plugin( 'cleaner' );

		$this->assertEquals(
			$cleaner->remove_shortcode( 'shortcode', $before ),
			$after
		);
	}

	function test_self_closing_shortcode_with_attributes() {
		$before = 'This is some content with a [shortcode position="testing" singlequote=\'\'] inside of it that also has attributes on the tag';
		$after = 'This is some content with a  inside of it that also has attributes on the tag';

		$cleaner = SC\get_plugin( 'cleaner' );

		$this->assertEquals(
			$cleaner->remove_shortcode( 'shortcode', $before ),
			$after
		);
	}

	function test_enclosing_shortcode() {
		$before = 'Content that has an enclosing shortcode. [shortcode]I am the content in the shortcode.[/shortcode] I am outside the shortcode.';
		$after = 'Content that has an enclosing shortcode. I am the content in the shortcode. I am outside the shortcode.';

		$cleaner = SC\get_plugin( 'cleaner' );

		$this->assertEquals(
			$cleaner->remove_shortcode( 'shortcode', $before ),
			$after
		);
	}

	function test_enclosing_shortcode_with_attributes() {
		$before = 'Content that has an enclosing shortcode. [shortcode attribute="value" singlequotes=\'othervalue!\']I am the content in the shortcode.[/shortcode] I am outside the shortcode.';
		$after = 'Content that has an enclosing shortcode. I am the content in the shortcode. I am outside the shortcode.';

		$cleaner = SC\get_plugin( 'cleaner' );

		$this->assertEquals(
			$cleaner->remove_shortcode( 'shortcode', $before ),
			$after
		);
	}

}