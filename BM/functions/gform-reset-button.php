<?php

class BM_GF_Reset_Button {

	private $label;

	function __construct() {
		$this->label = 'Reset';

		add_filter('gform_submit_button_1', [$this, 'button'], 10, 2);
	}

	function button($button, $form) {
		$button .= '<input class="reset-button" type="reset" value="' . $this->label . '">';
		return $button;
	}
}

// new BM_GF_Reset_Button;
