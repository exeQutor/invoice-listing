<?php

class BM_Attorney_Shortcode {

	private $entries;

	function __construct() {
		$this->entries = get_field('attorneys');

		add_shortcode('attorney', [$this, 'shortcode']);
	}

	function shortcode($atts) {
		$out = '';

		extract(shortcode_atts(array(
	    'id' => '',
			'direction' => ''
	  ), $atts));

		$attorney = $this->entries[$id - 1];

		if ($direction) $class = 'attorney-profile--reverse';

		$phone = format_phone_number($attorney['info']['phone']);

		$out .= "<div class='attorney-profile $class'>";
		$out .= '<div class="attorney-info">';
		$out .= "<h3>{$attorney['info']['name']}</h3>";
		$out .= "<p class='position'>{$attorney['info']['position']}</p>";
		$out .= "<p>Email: <a href='mailto:{$attorney['info']['email']}'>{$attorney['info']['email']}</a></p>";
		$out .= "<p>Phone: <a href='tel:+1{$phone}'>{$attorney['info']['phone']}</a></p>";
		$out .= "<p>Download: <a href='{$attorney['info']['vcard']['url']}' target='_blank'>vCard</a></p>";
		$out .= '</div>';
		$out .= '<div class="attorney-image">';
		$out .= "<img src='{$attorney['image']['url']}' alt='{$attorney['image']['alt']}'>";
		$out .= '</div>';
		$out .= '</div>';

	  return $out;
	}
}

// new BM_Attorney_Profiles_Shortcode;
