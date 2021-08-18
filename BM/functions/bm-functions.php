<?php

function bm_theme_url() {
	return get_template_directory_uri();
}

function bm_images_url($filespec) {
	return bm_theme_url() . '/assets/images/' . $filespec;
}

function format_phone_number($number) {
	return preg_replace('/[^0-9]/', '', $number);
}

function acf_link($link) {
	$title = $link['title'];
	$url = $link['url'];
	$target = $link['target'] ? " target='{$link['target']}'" : '';
	echo "<a href='$url'$target>$title</a>";
}
