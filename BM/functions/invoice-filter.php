<?php

function cpt_invoice_pre_get_posts( $query ) {

	// do not modify queries in the admin
	if ( is_admin() ) {
		return $query;
	}

	// only modify queries for 'invoice' post type
	if( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'invoice' ) {

		// allow the url to alter the query
		if( isset($_GET['status']) ) {
  		$query->set('meta_key', 'status');
			$query->set('meta_value', $_GET['status']);
  	}
	}

	return $query;

}
add_action('pre_get_posts', 'cpt_invoice_pre_get_posts');
