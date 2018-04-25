<?php
/*
Plugin Name: County Insert
Description: This is crud plugin. 
Version: 1
Author: Sakib Ahmed
Author URI: 
*/

function ajaxinsert()
	{
		global $wpdb;
		$county = $_POST["countyname"];
		$flag 	= ($_FILES["county-flag"]["tmp_name"]);
		$lat 	= $_POST["lat"];
		$lang 	= $_POST["lang"];
	
		$bin_string = file_get_contents("$flag"); 
		$aencode1 = base64_encode($bin_string);
		
		$wpdb->insert(
			'countries', 
			array('county' => $county,'flag' => $aencode1,'lat' => $lat,'lang' => $lang ) 
		  //array('%s', '%s') //data format           
		);
		$message.="Data inserted";
		}

	add_action( 'wp_ajax_ajaxinsert', 'ajaxinsert' );
	add_action('wp_ajax_nopriv_ajaxinsert', 'ajaxinsert');

	


//////////////////AJAX UPDATE/////////////////////////
function ajaxupdate()
	{
		global $wpdb;
		$table_name = "countries";
		$id 	= $_POST["id"];
		$county = $_POST["county"];
		$flag 	= ($_FILES["flag"]["tmp_name"]);
		$lat 	= $_POST["lat"];
		$lang 	= $_POST["lang"];
		
		
		//This code use for base64 encode
		$bin_string = file_get_contents("$flag"); //Use $flag(tmp_name) for base64
		$aencode1 = base64_encode($bin_string);
		//END base64 encode 

		if(!empty($flag)){
		//update with image
				$result = $wpdb->update(
							$table_name, //table
							array('county' => $county,'flag'=>$aencode1,'lat' => $lat,'lang' => $lang ), //data
							array('id' => $id) //where

					);
					var_dump($result);
		} 
		else {
		//update without image
				$result = $wpdb->update(
							$table_name, //table
							array('county' => $county,'lat' => $lat,'lang' => $lang), //data
							array('id' => $id) //where

					);
		}
		//End of If else use for image update problem, when i not update image has been deleted, thats why its used*/*/
	}
	
	add_action( 'wp_ajax_ajaxupdate', 'ajaxupdate' );
	add_action('wp_ajax_nopriv_ajaxupdate', 'ajaxupdate');
////////////////////////////////////////////


//////////////////START DELETE//////////////////////////

function delete_form()
	{
		
		if(isset($_POST['delete_row']))
		
		{
		$id=$_POST['row_id'];
		echo $row_no;
		global $wpdb;
		$table_name = "countries";
		$wpdb->delete($table_name, 
						array( 'id' => $id ) );
		 exit();
		}


	
	}
	
	add_action( 'wp_ajax_delete_form', 'delete_form' );
	add_action('wp_ajax_nopriv_delete_form', 'delete_form');
///////////////////END DELETE/////////////////////////



//menu items
add_action('admin_menu','wp_schools_modifymenu');
function wp_schools_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('County plugin', //page title
	'County', //menu title
	'manage_options', //capabilities
	'data_list', //menu slug
	'data_list', //function,
	'dashicons-admin-home'//icon
	);
	
	//this is a submenu
	add_submenu_page('data_list', //parent slug
	'Add New County', //page title
	'Add New County', //menu title
	'manage_options', //capability
	'data_create', //menu slug
	'data_create'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Update', //page title
	'Update', //menu title
	'manage_options', //capability
	'data_update', //menu slug
	'data_update'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Delete', //page title
	'Delete', //menu title
	'manage_options', //capability
	'data_delete', //menu slug
	'data_delete'); //function
}



//add js and css//
function loadOurJsfile()
{
	
	wp_enqueue_script('demo-ajax', plugin_dir_url(__FILE__).'js/demo-ajax.js', array('jquery'), '1.0',TRUE);
	wp_enqueue_script('els-ajax-def', plugin_dir_url(__FILE__).'js/els-ajax-def.js', array('jquery'), '1.1', TRUE);
	wp_enqueue_script('bootstrap.min.js', plugin_dir_url(__FILE__).'js/bootstrap.min.js', array('jquery'), '1.1', TRUE);
	
	
	wp_enqueue_style('style', plugin_dir_url(__FILE__).'css/style.css', '', '1.1');
	wp_enqueue_style('bootstrap.min', plugin_dir_url(__FILE__).'css/bootstrap.min.css', '', '1.1');
	wp_enqueue_style('responsive.css', plugin_dir_url(__FILE__).'css/responsive.css', '', '1.1');
}
add_action('admin_enqueue_scripts', 'loadOurJsfile');


//add js and css end//

define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'list.php');
require_once(ROOTDIR . 'create.php');
require_once(ROOTDIR . 'update.php');
require_once(ROOTDIR . 'delete.php');

 function eee($limit){
	$post_content= explode(" ", get_the_content());
	$less_content=array_slice($post_content,0,$limit);
  
	echo implode (" ",$less_content);
 }


?>