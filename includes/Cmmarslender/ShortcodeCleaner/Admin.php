<?php

namespace Cmmarslender\ShortcodeCleaner;

use Cmmarslender\ShortcodeCleaner\Admin\Ajax;
use Cmmarslender\ShortcodeCleaner\Admin\UI;

class Admin {

	/**
	 * @var \Marslender\ShortcodeCleaner\Admin\UI
	 */
	public $ui;

	/**
	 * @var \Marslender\ShortcodeCleaner\Admin\Ajax
	 */
	public $ajax;

	public function setup() {
		$this->ui = new UI();
		$this->ui->setup();

		$this->ajax = new Ajax();
		$this->ajax->setup();
	}

}
