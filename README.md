# Shortcode Cleaner [![Build Status](https://travis-ci.org/cmmarslender/shortcode-cleaner.svg?branch=master)](https://travis-ci.org/cmmarslender/shortcode-cleaner) [![Dockunit Status](https://dockunit.io/svg/cmmarslender/shortcode-cleaner?master)](https://dockunit.io/projects/cmmarslender/shortcode-cleaner#master)

Easily remove shortcodes from content in WordPress

## Background
Lots of themes and plugins use shortcodes to provide extra functionality. When you decide to switch themes or discontinue
use of a plugin, you're left with non-functioning shortcodes in your content. This plugin provides a way to clean up
the leftover shortcodes from your content across your whole site.

## Requirements
* PHP 5.3+

## Notes
The plugin is intended to remove all instances of a given shortcode, whether self-closing ```[shortcode]``` or enclosing
```[shortcode]Content inside enclosing shortcodes[/shortcode]```. If there is a demand for it, support for only one type
of shortcode could be added, but currently, trying to use the functions in this manner will *NOT* work as expected,
specifically if trying to only remove self closing shortcodes.
