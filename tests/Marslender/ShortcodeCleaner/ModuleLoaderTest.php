<?php

namespace Marslender\ShortcodeCleaner;

class ModuleLoaderTest extends \WP_UnitTestCase {

	function test_main_plugin_is_returned() {
		$returned = get_plugin();

		$this->assertInstanceOf( 'Marslender\\ShortcodeCleaner\\Plugin', $returned );
	}

	function test_is_singleton_instance() {
		$this->assertSame( get_plugin(), get_plugin() );
	}

	function test_first_level_resolves() {
		$randomClass = new \stdClass();
		$randomClass->property = rand( 1, 100 );

		$plugin = get_plugin();
		$plugin->firstLevel = $randomClass;

		$this->assertSame( $randomClass, get_plugin( 'firstLevel' ) );
	}

	function test_second_level_resolves() {
		$firstClass = new \stdClass();
		$firstClass->property = rand( 1, 100 );

		$secondClass = new \stdClass();
		$secondClass->otherProperty = rand( 1, 100 );

		$firstClass->secondClass = $secondClass;

		$plugin = get_plugin();
		$plugin->firstLevel = $firstClass;

		$this->assertSame( $secondClass, get_plugin( 'firstLevel.secondClass' ) );
	}

	function test_invalid_properties_throw_errors() {
		$this->setExpectedException( '\Exception' );
		get_plugin( 'i.dont.exist' );
	}
}
