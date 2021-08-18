<?php

class BM_Remove_Editor {

	private $pages;

	function __construct() {
		$this->pages = array(
			'overrides/home.php',
			'overrides/builder.php',
		);

		add_action('init', [$this, 'init']);
	}

	function init() {
		if (in_array(get_page_template_slug($_GET['post']), $this->pages)) {
			remove_post_type_support('page', 'editor');
		}
	}
}

new BM_Remove_Editor;
