<?php
	/*
	Plugin Name: Unar Extra
	Description: A plugin to add functionality to Theme Unar from Themes Awesome
	Version: 1.0.3
	Author: Themes Awesome
	Author URI: http://www.themesawesome.com
	License: GPLv2
	License URI: https://www.gnu.org/licenses/gpl-2.0.html

	Unar Extra is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 2 of the License, or
	any later version.
	 
	Unar Extra is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.
	 
	You should have received a copy of the GNU General Public License
	along with Unar Extra. If not, see https://www.gnu.org/licenses/gpl-2.0.html
	*/

	if ( ! defined( 'ABSPATH' ) ) exit;

	define( 'UNAR_EXTRA__FILE__', __FILE__ );
	define( 'UNAR_EXTRA_PLUGIN_BASE', plugin_basename( UNAR_EXTRA__FILE__ ) );
	define( 'UNAR_EXTRA_URL', plugins_url( '/', UNAR_EXTRA__FILE__ ) );
	define( 'UNAR_EXTRA_PATH', plugin_dir_path( UNAR_EXTRA__FILE__ ) );

	require_once UNAR_EXTRA_PATH.'inc/custom.php';
	require_once UNAR_EXTRA_PATH.'inc/element-helper.php';
	require_once UNAR_EXTRA_PATH.'inc/cmb2-function.php';

	function unar_extra_activation() {
		flush_rewrite_rules(true);
	}

	class unar_extra_class{}

	function unar_new_elements(){

	require_once ( UNAR_EXTRA_PATH.'slider-block/slider-control.php');
	require_once ( UNAR_EXTRA_PATH.'title-block/title-control.php');
	require_once ( UNAR_EXTRA_PATH.'testimonial-block/testimonial-control.php');
	require_once ( UNAR_EXTRA_PATH.'team-block/team-control.php');
	require_once ( UNAR_EXTRA_PATH.'partner-block/partner-control.php');
	require_once ( UNAR_EXTRA_PATH.'portfolio-block/portfolio-control.php');

	}
	add_action('elementor/widgets/widgets_registered','unar_new_elements');


/*-----------------------------------------------------------------------------------*/
/* The Portfolio custom post type
/*-----------------------------------------------------------------------------------*/
	add_action('init', 'unar_portfolio_register'); 
	function unar_portfolio_register() { 


		$labels = array(
			'name'               => _x('Portfolio', 'Portfolio General Name', 'unar'),
			'singular_name'      => _x('Portfolio', 'Portfolio Singular Name', 'unar'),
			'add_new'            => _x('Add New', 'Add New Portfolio Name', 'unar'),
			'add_new_item'       => __('Add New Portfolio', 'unar'),
			'edit_item'          => __('Edit Portfolio', 'unar'),
			'new_item'           => __('New Portfolio', 'unar'),
			'view_item'          => __('View Portfolio', 'unar'),
			'search_items'       => __('Search Portfolio', 'unar'),
			'not_found'          => __('Nothing found', 'unar'),
			'not_found_in_trash' => __('Nothing found in Trash', 'unar'),
			'parent_item_colon'  => ''
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'query_var'          => 'portfolio',
			'capability_type'    => 'post',
			'hierarchical'       => false,
			'rewrite'            => false,
			'supports'           => array('title','editor','thumbnail'),
			'menu_position'       => 5,

		); 

		register_post_type('unar-portfolio' , $args);
			
		register_taxonomy(
				"portfolio-category", array("unar-portfolio"), array(
				"hierarchical"   => true,
				"label"          => "Categories", 
				"singular_label" => "Categories", 
				"rewrite"        => true));
		register_taxonomy_for_object_type('portfolio-category', 'unar-portfolio');  

	}
			
	function unar_portfolio_edit_columns($columns) {  
		$columns = array(  
			"cb"          => "<input type=\"checkbox\" />",  
			"title"       => __('Project', 'unar'),  
			"type"        => __('Categories', 'unar'),  
		);    
		return $columns;  
	}    

	add_filter("manage_edit-portfolio_columns", "unar_portfolio_edit_columns"); 


	   
	function unar_portfolio_custom_columns($column) {  
		global $post;  
		switch ($column) {  

			case "type":  
				echo get_the_term_list($post->ID, 'portfolio-category', '', ', ','');  
				break;         
		}  
	}    

	add_action("manage_posts_custom_column",  "unar_portfolio_custom_columns");

/*-----------------------------------------------------------------------------------*/
/* The Testimonial custom post type
/*-----------------------------------------------------------------------------------*/


/*if ( ! function_exists('unar_testimonial_register') ) {

// Register Custom Post Type
function unar_testimonial_register() {

	$labels = array(
		'name'                => _x( 'Testimonial', 'Post Type General Name', 'unar' ),
		'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'unar' ),
		'menu_name'           => __( 'Testimonial', 'unar' ),
		'parent_item_colon'   => __( 'Parent Testimonial:', 'unar' ),
		'all_items'           => __( 'All Testimonial', 'unar' ),
		'view_item'           => __( 'View Testimonial', 'unar' ),
		'add_new_item'        => __( 'Add New Testimonial', 'unar' ),
		'add_new'             => __( 'Add New', 'unar' ),
		'edit_item'           => __( 'Edit Testimonial', 'unar' ),
		'update_item'         => __( 'Update Testimonial', 'unar' ),
		'search_items'        => __( 'Search Testimonial', 'unar' ),
		'not_found'           => __( 'Not found', 'unar' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'unar' ),
	);
	$args = array(
		'label'               => __( 'unar_testimonial', 'unar' ),
		'description'         => __( 'Testimonial post', 'unar' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'unar_testimonial', $args );

}

// Hook into the 'init' action
add_action( 'init', 'unar_testimonial_register', 0 );

}*/

/*-----------------------------------------------------------------------------------*/
/* The Partner custom post type
/*-----------------------------------------------------------------------------------*/

/*if ( ! function_exists('unar_partner_register') ) {

// Register Custom Post Type
function unar_partner_register() {

	$labels = array(
		'name'                => _x( 'Partner', 'Post Type General Name', 'unar' ),
		'singular_name'       => _x( 'Partner', 'Post Type Singular Name', 'unar' ),
		'menu_name'           => __( 'Partner', 'unar' ),
		'parent_item_colon'   => __( 'Parent Partner:', 'unar' ),
		'all_items'           => __( 'All Partner', 'unar' ),
		'view_item'           => __( 'View Partner', 'unar' ),
		'add_new_item'        => __( 'Add New Partner', 'unar' ),
		'add_new'             => __( 'Add New', 'unar' ),
		'edit_item'           => __( 'Edit Partner', 'unar' ),
		'update_item'         => __( 'Update Partner', 'unar' ),
		'search_items'        => __( 'Search Partner', 'unar' ),
		'not_found'           => __( 'Not found', 'unar' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'unar' ),
	);
	$args = array(
		'label'               => __( 'unar_partner', 'unar' ),
		'description'         => __( 'Partner post', 'unar' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'unar_partner', $args );

}

// Hook into the 'init' action
add_action( 'init', 'unar_partner_register', 0 );

}*/

/*-----------------------------------------------------------------------------------*/
/* The Team custom post type
/*-----------------------------------------------------------------------------------*/

/*if ( ! function_exists('unar_team_register') ) {

// Register Custom Post Type
function unar_team_register() {

	$labels = array(
		'name'                => _x( 'Team', 'Post Type General Name', 'unar' ),
		'singular_name'       => _x( 'Team', 'Post Type Singular Name', 'unar' ),
		'menu_name'           => __( 'Team', 'unar' ),
		'parent_item_colon'   => __( 'Parent Team:', 'unar' ),
		'all_items'           => __( 'All Team', 'unar' ),
		'view_item'           => __( 'View Team', 'unar' ),
		'add_new_item'        => __( 'Add New Team', 'unar' ),
		'add_new'             => __( 'Add New', 'unar' ),
		'edit_item'           => __( 'Edit Team', 'unar' ),
		'update_item'         => __( 'Update Team', 'unar' ),
		'search_items'        => __( 'Search Team', 'unar' ),
		'not_found'           => __( 'Not found', 'unar' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'unar' ),
	);
	$args = array(
		'label'               => __( 'unar_team', 'unar' ),
		'description'         => __( 'Team post', 'unar' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'unar_team', $args );

}

// Hook into the 'init' action
add_action( 'init', 'unar_team_register', 0 );

}*/