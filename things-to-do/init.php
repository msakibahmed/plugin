<?php
/*
Plugin Name: Things to do
Description: This is crud plugin. 
Version: 1
Author: Sakib Ahmed
Author URI: 
*/

function things_ajaxinsert()
	{
		global $wpdb;
		$thnigs1 		= $_POST["thnigs1"];
		$thnigs2 		= $_POST["thnigs2"];
		$thnigs3 		= $_POST["thnigs3"];
		$thnigs4 		= $_POST["thnigs4"];
		$thnigs5 		= $_POST["thnigs5"];
		$things_county 	= $_POST["things_county"];
	

		
		var_dump($thnigs1);
		var_dump($thnigs2);
		var_dump($thnigs3);
		var_dump($thnigs4);
		var_dump($thnigs5);
		var_dump($things_county); 
		


		$wpdb->insert(
			'things_to_do', //table
			array('things_1' => $thnigs1,
			'things_2' 	=> $thnigs2,
			'things_3' 	=> $thnigs3,
			'things_4' 	=> $thnigs4,
			'things_5' 	=> $thnigs5,
			'county' 	=> $things_county) //data
		  //array('%s', '%s') //data format
		);
		$message.="Data inserted";
		}

	add_action( 'wp_ajax_things_ajaxinsert', 'things_ajaxinsert' );
	add_action('wp_ajax_nopriv_things_ajaxinsert', 'things_ajaxinsert');

	


//////////////////AJAX UPDATE/////////////////////////
function things_ajaxupdate()
	{
		global $wpdb;
		$table_name = "things_to_do";
		
		$id 	= $_POST["id"];
		$things1 = $_POST["things_1"];
		$things2 = $_POST["things_2"];
		$things3 = $_POST["things_3"];
		$things4 = $_POST["things_4"];
		$things5 = $_POST["things_5"];
		$county = $_POST["county"];
		
		$result = $wpdb->update(
						$table_name, //table
						array(
							'things_1'	=> $things1,
							'things_2' 	=> $things2,
							'things_3' 	=> $things3,
							'things_4' 	=> $things4,
							'things_5' 	=> $things5,
							'county' 	=> $county), //data
						array('id' => $id) //where

						);
	}
	add_action( 'wp_ajax_things_ajaxupdate', 'things_ajaxupdate' );
	add_action('wp_ajax_nopriv_things_ajaxupdate', 'things_ajaxupdate');




////////////////////////////////////////////




//menu items
add_action('admin_menu','things_wp_modifymenu');
function things_wp_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('Things to do plugin', //page title
	'Things To Do', //menu title
	'manage_options', //capabilities
	'thingsdatalist', //menu slug
	'thingsdatalist', //function,
	'dashicons-welcome-widgets-menus'//icon
	);
	
	//this is a submenu
	add_submenu_page('thingsdatalist', //parent slug
	'Add New Things', //page title
	'Add New Things', //menu title
	'manage_options', //capability
	'things_data_create', //menu slug
	'things_data_create'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Update', //page title
	'Update', //menu title
	'manage_options', //capability
	'things_data_update', //menu slug
	'things_data_update'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Delete', //page title
	'Delete', //menu title
	'manage_options', //capability
	'things_data_delete', //menu slug
	'things_data_delete'); //function
}



//add js and css//
function things_loadOurJsfile()
{
	
	wp_enqueue_script('demo-ajax', plugin_dir_url(__FILE__).'js/demo-ajax.js', array('jquery'), '1.0',TRUE);
	wp_enqueue_script('els-ajax-def', plugin_dir_url(__FILE__).'js/els-ajax-def.js', array('jquery'), '1.1', TRUE);
	wp_enqueue_script('bootstrap.min.js', plugin_dir_url(__FILE__).'js/bootstrap.min.js', array('jquery'), '1.1', TRUE);
	
	
	wp_enqueue_style('style', plugin_dir_url(__FILE__).'css/style.css', '', '1.1');
	wp_enqueue_style('bootstrap.min', plugin_dir_url(__FILE__).'css/bootstrap.min.css', '', '1.1');
	wp_enqueue_style('responsive.css', plugin_dir_url(__FILE__).'css/responsive.css', '', '1.1');
}
add_action('admin_enqueue_scripts', 'things_loadOurJsfile');


//add js and css end//

define('things_ROOTDIR', plugin_dir_path(__FILE__));
require_once(things_ROOTDIR . 'thingslist.php');
require_once(things_ROOTDIR . 'create.php');
require_once(things_ROOTDIR . 'update.php');
require_once(things_ROOTDIR . 'delete.php');

 function things_limit($limit){
	$post_content= explode(" ", get_the_content());
	$less_content=array_slice($post_content,0,$limit);
  
	echo implode (" ",$less_content);
 }
 




?>