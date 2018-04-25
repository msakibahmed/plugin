<?php
/*
Plugin Name: Subscriber List
Description: This is subscriber list viewer plugin . 
Version: 1
Author: Sakib Ahmed
Author URI: 
*/

function subs_ajaxinsert()
	{
		global $wpdb;
		$subscribe = $_POST["subscribename"];
		$flag 	= ($_FILES["subscribe-flag"]["tmp_name"]);
		$lat 	= $_POST["lat"];
		$lang 	= $_POST["lang"];
	
		$bin_string = file_get_contents("$flag"); 
		$aencode1 = base64_encode($bin_string);
		
		$wpdb->insert(
			'countries', 
			array('subscribe' => $subscribe,'flag' => $aencode1,'lat' => $lat,'lang' => $lang ) 
		  //array('%s', '%s') //data format           
		);
		$message.="Data inserted";
		}

	add_action( 'wp_ajax_subs_ajaxinsert', 'subs_ajaxinsert' );
	add_action('wp_ajax_nopriv_subs_ajaxinsert', 'subs_ajaxinsert');

	


//////////////////AJAX UPDATE/////////////////////////
function subs_ajaxupdate()
	{
		global $wpdb;
		$table_name = "countries";
		$id 	= $_POST["id"];
		$subscribe = $_POST["subscribe"];
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
							array('subscribe' => $subscribe,'flag'=>$aencode1,'lat' => $lat,'lang' => $lang ), //data
							array('id' => $id) //where

					);
					var_dump($result);
		} 
		else {
		//update without image
				$result = $wpdb->update(
							$table_name, //table
							array('subscribe' => $subscribe,'lat' => $lat,'lang' => $lang), //data
							array('id' => $id) //where

					);
		}
		//End of If else use for image update problem, when i not update image has been deleted, thats why its used*/*/
	}
	
	add_action( 'wp_ajax_subs_ajaxupdate', 'subs_ajaxupdate' );
	add_action('wp_ajax_nopriv_subs_ajaxupdate', 'subs_ajaxupdate');
////////////////////////////////////////////


//////////////////START DELETE//////////////////////////

function subs_delete()
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
	
	add_action( 'wp_ajax_subs_delete', 'subs_delete' );
	add_action('wp_ajax_nopriv_subs_delete', 'subs_delete');
///////////////////END DELETE/////////////////////////



//menu items
add_action('admin_menu','subscriber');
function subscriber() {
	
	//this is the main item for the menu
	add_menu_page('subs_data_list', //page title
	'Subscriber List', //menu title
	'manage_options', //capabilities
	'subs_data_list', //menu slug
	'subs_data_list', //function,
	'dashicons-image-filter'//icon
	);
	
/* 	add_submenu_page('subs_data_list', //page title
	'Subscriber', //menu title
	'manage_options', //capabilities
	'subs_data_list', //menu slug
	'subs_data_list', //function,
	'dashicons-admin-home'//icon
	); */
	
	//this is a submenu
/* 	add_submenu_page('subs_data_list', //parent slug
	'Add New Subscriber', //page title
	'Add New Subscriber', //menu title
	'manage_options', //capability
	'subs_data_create', //menu slug
	'subs_data_create'); //function
	 */
}



//add js and css//
function subs_loadOurJsfile()
{
	
	wp_enqueue_script('demo-ajax', plugin_dir_url(__FILE__).'js/demo-ajax.js', array('jquery'), '1.0',TRUE);
	wp_enqueue_script('els-ajax-def', plugin_dir_url(__FILE__).'js/els-ajax-def.js', array('jquery'), '1.1', TRUE);
	wp_enqueue_script('bootstrap.min.js', plugin_dir_url(__FILE__).'js/bootstrap.min.js', array('jquery'), '1.1', TRUE);
	
	
	wp_enqueue_style('style', plugin_dir_url(__FILE__).'css/style.css', '', '1.1');
	wp_enqueue_style('bootstrap.min', plugin_dir_url(__FILE__).'css/bootstrap.min.css', '', '1.1');
	wp_enqueue_style('responsive.css', plugin_dir_url(__FILE__).'css/responsive.css', '', '1.1');
}
add_action('admin_enqueue_scripts', 'subs_loadOurJsfile');


//add js and css end//

define('ROOTDIRR', plugin_dir_path(__FILE__));
require_once(ROOTDIRR . 'list.php');
//require_once(ROOTDIRR . 'create.php');
//require_once(ROOTDIR . 'update.php');
//require_once(ROOTDIR . 'delete.php');

 function subslimit($limit){
	$post_content= explode(" ", get_the_content());
	$less_content=array_slice($post_content,0,$limit);
  
	echo implode (" ",$less_content);
 }


?>