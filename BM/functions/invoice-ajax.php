<?php

add_action('wp_ajax_mark_as_paid', 'mark_as_paid');
add_action('wp_ajax_nopriv_mark_as_paid', 'mark_as_paid');

function mark_as_paid() {
	$id = sanitize_text_field($_POST['id']);
	$status = update_field('status', 'paid', $id);

	$data = array(
		'id' => sanitize_text_field($_POST['id']),
		'result' => $status
	);

	echo json_encode($data);

	die();
}
