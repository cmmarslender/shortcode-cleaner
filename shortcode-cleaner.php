<?php
/**
 * Plugin Name: Shortcode Cleaner
 * Description: Shortcode Cleaner for WordPress
 * Version: 1.0.0
 * Author: Chris Marslender
 * Author URI: http://chrismarslender.com/
 */

namespace Cmmarslender\ShortcodeCleaner;

// Include the autoloader, or fail
if ( ! file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	throw new \Exception( "Autoload file does not exist. Please run `composer install`" );
}
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Returns the main plugin container or a specific property within
 *
 * @param string $plugin_part the part of the plugin to return
 *
 * @throws \Exception when the requested property cannot be found
 *
 * @return mixed Returns the requested property, or the main plugin if nothing more specific requested
 */
function get_plugin( $plugin_part = null ) {
	static $plugin;

	if ( empty( $plugin ) ) {
		$plugin = new Plugin();
		$plugin->setup( __FILE__ );
	}

	if ( ! is_null( $plugin_part ) ) {
		$current_class = $plugin;
		$classes = explode( '.', $plugin_part );
		$property = array_pop( $classes );

		// Find the innermost class
		if ( ! empty( $classes ) ) {
			foreach( $classes as $class ) {
				if ( property_exists( $current_class, $class ) ) {
					if ( ! is_object( $current_class->{$class} ) ) {
						$current_class_name = get_class( $current_class );
						throw new \Exception( "{$class} is not an object within $current_class_name" );
					}

					$current_class = $current_class->{$class};
				}
			}
		}

		// Get the property, now that we have the innermost class
		if ( ! property_exists( $current_class, $property ) ) {
			$current_class_name = get_class( $current_class );
			throw new \Exception( "{$property} is not a part of {$current_class_name}" );
		}

		return $current_class->{$property};
	}

	return $plugin;
}

// Gets the whole process rolling
get_plugin();
