<?php

class BM_Custom_Excerpt {

	private $length;
	private $label;

	function __construct() {
		$this->length = 58;
		$this->label = 'Read more';

		add_action('wp', [$this, 'wp']);
	}

	function wp() {
		if (is_home()) {
			add_filter('excerpt_length', [$this, 'excerpt_length']);
			add_filter('excerpt_more', [$this, 'excerpt_more']);

			if ($this->label) {
				add_filter('get_the_excerpt', [$this, 'get_the_excerpt']);
			}
		}
	}

	function excerpt_length($length) {
		return $this->length;
	}

	function excerpt_more($more) {
	  return '';
	}

	function get_the_excerpt($excerpt) {
	  $post = get_post();
	  $excerpt .= ' <a class="read-more" href="'. get_permalink($post->ID) . '">' . $this->label . '</a>';
	  return $excerpt;
	}
}

new BM_Custom_Excerpt;
