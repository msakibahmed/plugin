<?php
/*
Plugin Name: Reviews
Description: This is crud plugin. 
Version: 1
Author: Sakib Ahmed
Author URI: 
*/
 

function reviews_ajaxinsert()
	{
		global $wpdb;
		$hotel_id 		= $_POST["hotel_id"];
		$rating 		= $_POST["rating"];

		$wpdb->insert(
			'reviews', 
			array(
			'hotel_id' 	=> $hotel_id,
			'rating' 	=> $rating) 
		);
		$message.="Data inserted";
		}

	add_action( 'wp_ajax_reviews_ajaxinsert', 'reviews_ajaxinsert' );
	add_action('wp_ajax_nopriv_reviews_ajaxinsert', 'reviews_ajaxinsert');

	


//////////////////AJAX UPDATE/////////////////////////
function reviews_ajaxupdate()
	{
		global $wpdb;
		$table_name = "reviews";
		
		$id 	= $_POST["id"];
		$rating = $_POST["rating"];
		$hotel_id = $_POST["hotel_id"];
		
		
		$result = $wpdb->update(
						$table_name, //table
						array(
							'hotel_id'	=> $hotel_id,
							'rating' 	=> $rating), //data
						array('id' => $id) //where

						);
	}
	add_action( 'wp_ajax_reviews_ajaxupdate', 'reviews_ajaxupdate' );
	add_action('wp_ajax_nopriv_reviews_ajaxupdate', 'reviews_ajaxupdate');




////////////////////////////////////////////




//menu items
add_action('admin_menu','reviews_wp_modifymenu');
function reviews_wp_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('reviews plugin', //page title
	'Reviews', //menu title
	'manage_options', //capabilities
	'reviews_data_list', //menu slug
	'reviews_data_list', //function,
	'dashicons-star-half'//icon
	);
	
	//this is a submenu
	add_submenu_page('reviews_data_list', //parent slug
	'Add New Reviews', //page title
	'Add New Reviews', //menu title
	'manage_options', //capability
	'reviews_data_create', //menu slug
	'reviews_data_create'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Update', //page title
	'Update', //menu title
	'manage_options', //capability
	'reviews_data_update', //menu slug
	'reviews_data_update'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Delete', //page title
	'Delete', //menu title
	'manage_options', //capability
	'reviews_data_delete', //menu slug
	'reviews_data_delete'); //function
}



//add js and css//
function reviews_loadOurJsfile()
{
	
	wp_enqueue_script('demo-ajax', plugin_dir_url(__FILE__).'js/demo-ajax.js', array('jquery'), '1.0',TRUE);
	wp_enqueue_script('els-ajax-def', plugin_dir_url(__FILE__).'js/els-ajax-def.js', array('jquery'), '1.1', TRUE);
	wp_enqueue_script('bootstrap.min.js', plugin_dir_url(__FILE__).'js/bootstrap.min.js', array('jquery'), '1.1', TRUE);
	
	
	wp_enqueue_style('style', plugin_dir_url(__FILE__).'css/style.css', '', '1.1');
	wp_enqueue_style('bootstrap.min', plugin_dir_url(__FILE__).'css/bootstrap.min.css', '', '1.1');
	wp_enqueue_style('responsive.css', plugin_dir_url(__FILE__).'css/responsive.css', '', '1.1');
	//wp_enqueue_style('responsive.css',  'href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css"', '', '1.1');
}
add_action('admin_enqueue_scripts', 'reviews_loadOurJsfile');


//add js and css end//

define('thing_ROOTDIR', plugin_dir_path(__FILE__));
require_once(thing_ROOTDIR . 'list.php');
require_once(thing_ROOTDIR . 'create.php');
require_once(thing_ROOTDIR . 'update.php');
require_once(thing_ROOTDIR . 'delete.php');

 function reviews_limit($limit){
	$post_content= explode(" ", get_the_content());
	$less_content=array_slice($post_content,0,$limit);
  
	echo implode (" ",$less_content);
 }


?>