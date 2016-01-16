<?php

namespace Marslender\ShortcodeCleaner;

class Plugin {

	/**
	 * @var \Marslender\ShortcodeCleaner\Cleaner
	 */
	public $cleaner;

	public function setup() {
		$this->cleaner = new Cleaner();
	}

}
