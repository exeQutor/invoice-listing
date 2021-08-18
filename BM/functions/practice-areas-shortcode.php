<?php

class BM_Practice_Areas_Shortcode {

	private $entries;

	function __construct() {
		$this->entries = get_field('practice');

		add_shortcode('practice-areas', 'shortcode');
	}

	function shortcode() {
		$out = '<ul class="practice-list">';

		foreach ($this->entries as $entry) {
			$permalink = get_permalink($entry['page']->ID);
			$title = get_the_title($entry['page']->ID);
			$thumb = $entry['image']['url'];
			$out .= "<li><a href='$permalink' style='background-image: url($thumb)'><div class='overlay'>$title</div></a></li>";
		}

		$out .= "</ul>";

	  return $out;
	}
}

// new BM_Practice_Areas_Shortcode;
