<?php


add_action( 'cmb2_init', 'bh_pricing_table_metabox' );

function bh_pricing_table_metabox(){
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_bhpr_';

	
	
	$cmb2_bhpricing_table = new_cmb2_box( array(
		'id'           => $prefix . 'pricing_table_options',
		'title'        => esc_html__( 'Pricing Table Info', 'bh-pricing' ),
		'object_types' => array( 'bh_pricing'), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		//'show_on'      => array( 'id' => array( 2, ) ), // Specific post IDs to display this metabox
	) );

	$cmb2_bhpricing_table->add_field( array(
	    'name'             => esc_html__('Feature Plan' , 'bh-pricing'),
	    'id'               => $prefix .'pt_feaure_plan_opt',
		'type'             => 'checkbox',
		'desc'             => esc_html__( 'choice your feature plan here','bh-pricing' ),
		'default'    => '0',
	) );
	
	$cmb2_bhpricing_table->add_field( array(
	    'name'             => esc_html__('Currency Type' , 'bh-pricing'),
	    'id'               => $prefix .'pt_currency_type',
	    'desc'             => esc_html__( 'write currency type here','bh-pricing' ),
		'type'             => 'text',
		'default'    => '$',
	) );		
	
	$cmb2_bhpricing_table->add_field( array(
	    'name'             => esc_html__('Amount' , 'bh-pricing'),
	    'id'               => $prefix .'pt_amount',
	    'desc'             => esc_html__( 'write amount here','bh-pricing' ),
		'type'             => 'text',
		'default'    => '50',
	) );	
	
	$cmb2_bhpricing_table->add_field( array(
	    'name'             => esc_html__('Period' , 'bh-pricing'),
	    'id'               => $prefix .'pt_period',
	    'desc'             => esc_html__( 'write period here','bh-pricing' ),
		'type'             => 'text',
		'default'    => 'year',
	) );	
	$pricing_field_id = $cmb2_bhpricing_table->add_field( array(
		'id'          => $prefix .'pricing_group_field_opt',
		'type'        => 'group',
		// 'repeatable'  => false, // use false if you want non-repeatable group
		'options'     => array(
			'group_title'   => __( 'Pricing Feature {#}', 'bh-pricing' ), // since version 1.1.4, {#} gets replaced by row number
			'add_button'    => __( 'Add New Feature', 'bh-pricing' ),
			'remove_button' => __( 'Remove Feature', 'bh-pricing' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	// Id's for group's fields only need to be unique for the group. Prefix is not needed.
	$cmb2_bhpricing_table->add_group_field( $pricing_field_id, array(
		'name' => 'Feature',
		'id'   => $prefix .'pt_feature',
		'type' => 'text',
		'default' => '500 Space',
	) );	
	
	$cmb2_bhpricing_table->add_field( array(
	    'name'             => esc_html__('Button Text' , 'bh-pricing'),
	    'id'               => $prefix .'pt_button_text',
	    'desc'             => esc_html__( 'write Button text here','bh-pricing' ),
		'type'             => 'text',
		'default'    => 'Choice Plan',
	) );	
	
	$cmb2_bhpricing_table->add_field( array(
	    'name'             => esc_html__('Button Link' , 'bh-pricing'),
	    'id'               => $prefix .'pt_button_link',
	    'desc'             => esc_html__( 'write Button link here','bh-pricing' ),
		'type'             => 'text',
		'default'    => '#',
	) );	
}