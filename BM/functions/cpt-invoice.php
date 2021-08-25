<?php

// Register Custom Post Type
function cpt_invoice() {

	$labels = array(
		'name'                  => _x( 'Invoices', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Invoice', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Invoices', 'text_domain' ),
		'name_admin_bar'        => __( 'Invoices', 'text_domain' ),
		'archives'              => __( 'Invoice Archives', 'text_domain' ),
		'attributes'            => __( 'Invoice Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Invoices', 'text_domain' ),
		'add_new_item'          => __( 'Add New Invoice', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Invoice', 'text_domain' ),
		'edit_item'             => __( 'Edit Invoice', 'text_domain' ),
		'update_item'           => __( 'Update Invoice', 'text_domain' ),
		'view_item'             => __( 'View Invoice', 'text_domain' ),
		'view_items'            => __( 'View Invoices', 'text_domain' ),
		'search_items'          => __( 'Search Invoice', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into invoice', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this invoice', 'text_domain' ),
		'items_list'            => __( 'Invoices list', 'text_domain' ),
		'items_list_navigation' => __( 'Invoices list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter invoices list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Invoice', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_in_rest'					=> true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'							=> 'dashicons-text-page',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'								=> array( 'slug' => 'invoices', 'with_front' => false ), // change slug from 'invoice' to 'invoices' for the CPT archive page
		'capability_type'       => 'page',
	);
	register_post_type( 'invoice', $args );

	// rewrite rule to translate 'invoices' slug to 'invoice' and add the CPT ID for the CPT single page
	add_rewrite_rule(
    'invoice/([0-9]+)?$',
    'index.php?post_type=invoice&p=$matches[1]',
    'top' );

}
add_action( 'init', 'cpt_invoice', 0 );

// filter to return the correct URLs for any calls to get_post_permalink()
function cpt_invoice_post_type_link( $link, $post = 0 ) {
  if ( $post->post_type == 'invoice' ) {
    return home_url( 'invoice/' . $post->ID );
	} else {
    return $link;
  }
}
add_filter('post_type_link', 'cpt_invoice_post_type_link', 1, 3);
