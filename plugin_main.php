<?php

/*
Plugin Name: BH Pricing Table
Plugin URI: http://getmasum.net/plugins/bh-pricing-table
Description: This is BH pricing table WordPress plugin.You can make easily your package/plan by using it enjoy
Author: Masum Billah
Author URI: http://getmasum.net
Version: 1.2
Text Domain: bh-pricing
*/

add_action( 'plugins_loaded', 'bh_pricing_load_textdomain' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function bh_pricing_load_textdomain() {
  load_plugin_textdomain( 'bh-pricing', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}


// Some configure
define('BH_PRICING_TABLE_WORDPRESS' , WP_PLUGIN_URL .'/' . plugin_basename(dirname(__FILE__)) . '/');

// Adding css and jquery files
function bh_pricing_table_css_files(){
	
	wp_enqueue_style('bootstrap' , BH_PRICING_TABLE_WORDPRESS .'css/bootstrap.css' );		
	wp_enqueue_style('' , BH_PRICING_TABLE_WORDPRESS .'css/bh_pricing_table.css' );		
}

add_action('wp_enqueue_scripts' , 'bh_pricing_table_css_files');



//define

define( 'BHPRICINGPLUGINDIR', dirname( __FILE__ ) ); 

// Add main files

include_once(BHPRICINGPLUGINDIR. '/custom_posts.php');
include_once(BHPRICINGPLUGINDIR. '/bh_pricing_opt.php');

/**
 * Detect plugin. For use on Front End only.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );



function bh_pricing_plug_install() {
	/**
	 * Detect plugin. For use in Admin area only.
	 */
	if (is_plugin_active( 'cmb2/init.php' ) ) {

	}else{
		echo '<div id="message" class="updated below-h2 rs-update-notice-wrap" style="margin-left: 185px; padding-left: 15px;"><p><strong>Please Install and Active CMB2 Plugin for run - BH Pricing Table . <a href="//wordpress.org/plugins/cmb2/" target="_blank">Click Here</a></strong></p></div>';
	} 
}
add_action( 'admin_init', 'bh_pricing_plug_install' );




//Pricing Table
function bh_pricing_table_shortcode( $atts , $content = null ){
 // Attributes
    extract( shortcode_atts(
        array(
			'post_number'	=> '4',						
			'pri_color'	=> '',						
		), $atts )
    );
ob_start();

?>

	<!-- Start pricing -->
	<section id="pricing" class="pricing_area">
			<div class="row">		
				<!-- End pricing -->
				<?php
					// WP_Query arguments
					$args = array (
						'post_type'              => array( 'bh_pricing' ),
						'posts_per_page'         => $post_number,
					);

					// The Query
					$bh_pricing = new WP_Query( $args );

					// The Loop
					if ( $bh_pricing->have_posts() ) {
						while ( $bh_pricing->have_posts() ) {
							$bh_pricing->the_post();
							$bh_pt_feaure_plan = get_post_meta(get_the_ID(),'_bhpr_pt_feaure_plan_opt',true);	
							$bh_pt_currency_type = get_post_meta(get_the_ID(),'_bhpr_pt_currency_type',true);	
							$bh_pt_amount = get_post_meta(get_the_ID(),'_bhpr_pt_amount',true);	
							$bh_pt_period = get_post_meta(get_the_ID(),'_bhpr_pt_period',true);	
							$bh_pricing_group_field_opt = get_post_meta(get_the_ID(),'_bhpr_pricing_group_field_opt',true);	
							$bh_pt_button_text = get_post_meta(get_the_ID(),'_bhpr_pt_button_text',true);	
							$bh_pt_button_link = get_post_meta(get_the_ID(),'_bhpr_pt_button_link',true);	
							
							?>
								<div class="col-md-3 col-sm-6">
									<div class="single_pricing <?php if($bh_pt_feaure_plan == true){ echo esc_attr('feature');}?>">
										<header class="header">
											<h4 class="plan_name"><?php the_title();?></h4>
											<div class="price">
												<div class="amount"><?php echo esc_html($bh_pt_currency_type); echo esc_html($bh_pt_amount);?></div>
												<div class="period"><?php echo esc_html($bh_pt_period);?></div>
											</div>
										</header>
										
										<ul class="pri_list">
										<?php
											foreach ( (array) $bh_pricing_group_field_opt as $key => $pt_entry ) {

											$feature = '';

											if ( isset( $pt_entry['_bhpr_pt_feature'] ) )
											$feature = $pt_entry['_bhpr_pt_feature'] ;
											 ?>
											<li><?php echo esc_html($feature);?></li>
								
											<?php } ?>			
											
										</ul>
										
										<div class="pfooter">
											<a href="<?php echo esc_url($bh_pt_button_link);?>" class=" radon"><?php echo esc_html($bh_pt_button_text);?></a>
										</div>
									</div>			
								</div>
					<?php	}
					} else {
						// no posts found
					}

					// Restore original Post Data
					wp_reset_postdata();
				?>			
			</div>		
	</section>
	
<style type="text/css">
	.single_pricing .price,
	.single_pricing:hover,
	.single_pricing.feature,
	.radon{
		background: <?php echo esc_attr($pri_color);?>;
	}

	.single_pricing:hover .price:before,
	.single_pricing.feature .price:before{
		border-color: <?php echo esc_attr($pri_color);?>;
	}
	.single_pricing:hover .price,
	.single_pricing.feature .price

	{
		color: <?php echo esc_attr($pri_color);?>;
	}

	.single_pricing:hover .radon,
	.single_pricing.feature .radon{
		color: <?php echo esc_attr($pri_color);?>;
	}
	.radon{
		border-color: <?php echo esc_attr($pri_color);?> ;
		
	}
	.radon:hover, 
	.radon:focus{
		color: <?php echo esc_attr($pri_color);?>;
		border-color: <?php echo esc_attr($pri_color);?>;
	}

</style>	
		
<?php 
  return ob_get_clean();
}
add_shortcode ('bh_pricing_table', 'bh_pricing_table_shortcode' );

