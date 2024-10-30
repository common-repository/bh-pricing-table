<?php


if ( ! function_exists('bh_pricing_table') ) {

// Register Custom Post Type
function bh_pricing_table() {

	$labels = array(
		'name'                  => _x( 'Pricing Table', 'Post Type General Name', 'bh-pricing' ),
		'singular_name'         => _x( 'Pricing Table', 'Post Type Singular Name', 'bh-pricing' ),
		'menu_name'             => __( 'BH Pricing Table', 'bh-pricing' ),
		'name_admin_bar'        => __( 'BH Pricing Table', 'bh-pricing' ),
		'archives'              => __( 'Item Archives', 'bh-pricing' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bh-pricing' ),
		'all_items'             => __( 'All Items', 'bh-pricing' ),
		'add_new_item'          => __( 'Add New Item', 'bh-pricing' ),
		'add_new'               => __( 'Add New', 'bh-pricing' ),
		'new_item'              => __( 'New Item', 'bh-pricing' ),
		'edit_item'             => __( 'Edit Item', 'bh-pricing' ),
		'update_item'           => __( 'Update Item', 'bh-pricing' ),
		'view_item'             => __( 'View Item', 'bh-pricing' ),
		'search_items'          => __( 'Search Item', 'bh-pricing' ),
		'not_found'             => __( 'Not found', 'bh-pricing' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bh-pricing' ),
		'featured_image'        => __( 'Featured Image', 'bh-pricing' ),
		'set_featured_image'    => __( 'Set featured image', 'bh-pricing' ),
		'remove_featured_image' => __( 'Remove featured image', 'bh-pricing' ),
		'use_featured_image'    => __( 'Use as featured image', 'bh-pricing' ),
		'insert_into_item'      => __( 'Insert into item', 'bh-pricing' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bh-pricing' ),
		'items_list'            => __( 'Items list', 'bh-pricing' ),
		'items_list_navigation' => __( 'Items list navigation', 'bh-pricing' ),
		'filter_items_list'     => __( 'Filter items list', 'bh-pricing' ),
	);
	$args = array(
		'label'                 => __( 'Pricing Table', 'bh-pricing' ),
		'labels'                => $labels,
		'supports'              => array( 'title', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'   => 'dashicons-grid-view',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'bh_pricing', $args );

}
add_action( 'init', 'bh_pricing_table', 0 );

}

