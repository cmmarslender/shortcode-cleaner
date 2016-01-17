<?php

namespace Cmmarslender\ShortcodeCleaner;

class RemoveShortcodeTest extends \WP_UnitTestCase {

	function test_self_closing_shortcode() {
		$before = 'This is some content with a [shortcode] inside of it';
		$after = 'This is some content with a  inside of it';

		$cleaner = get_plugin( 'cleaner' );

		$this->assertEquals(
			$after,
			$cleaner->remove_shortcode( 'shortcode', $before )
		);
	}

	function test_self_closing_shortcode_with_attributes() {
		$before = 'This is some content with a [shortcode position="testing" singlequote=\'\'] inside of it that also has attributes on the tag';
		$after = 'This is some content with a  inside of it that also has attributes on the tag';

		$cleaner = get_plugin( 'cleaner' );

		$this->assertEquals(
			$after,
			$cleaner->remove_shortcode( 'shortcode', $before )
		);
	}

	function test_enclosing_shortcode() {
		$before = 'Content that has an enclosing shortcode. [shortcode]I am the content in the shortcode.[/shortcode] I am outside the shortcode.';
		$after = 'Content that has an enclosing shortcode. I am the content in the shortcode. I am outside the shortcode.';

		$cleaner = get_plugin( 'cleaner' );

		$this->assertEquals(
			$after,
			$cleaner->remove_shortcode( 'shortcode', $before )
		);
	}

	function test_enclosing_shortcode_with_attributes() {
		$before = 'Content that has an enclosing shortcode. [shortcode attribute="value" singlequotes=\'othervalue!\']I am the content in the shortcode.[/shortcode] I am outside the shortcode.';
		$after = 'Content that has an enclosing shortcode. I am the content in the shortcode. I am outside the shortcode.';

		$cleaner = get_plugin( 'cleaner' );

		$this->assertEquals(
			$after,
			$cleaner->remove_shortcode( 'shortcode', $before )
		);
	}

	function test_nested_same_shortcode() {
		$before = 'Content with nested [shortcode]Inside content[shortcode]something here[/shortcode]more content[/shortcode]';
		$after = 'Content with nested Inside contentsomething heremore content';

		$cleaner = get_plugin( 'cleaner' );

		$this->assertEquals(
			$after,
			$cleaner->remove_shortcode( 'shortcode', $before )
		);
	}

	function test_nested_different_shortcode() {
		$before = 'Content with nested [shortcode]Inside content[bold]bold text[/bold][/shortcode]';
		$after = 'Content with nested Inside content[bold]bold text[/bold]';

		$cleaner = get_plugin( 'cleaner' );

		$this->assertEquals(
			$after,
			$cleaner->remove_shortcode( 'shortcode', $before )
		);
	}

	function test_square_brackets_in_enclosing_shortcode() {
		$before = 'Content with nested [shortcode]Inside content[bold]bold text[/bold] and a random square bracket[/shortcode]';
		$after = 'Content with nested Inside content[bold]bold text[/bold] and a random square bracket';

		$cleaner = get_plugin( 'cleaner' );

		// @todo do we need to flip these so expected/actual line up?
		$this->assertEquals(
			$after,
			$cleaner->remove_shortcode( 'shortcode', $before )
		);
	}

}