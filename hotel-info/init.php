<?php
/*
Plugin Name: Hotel Information
Description: This is crud plugin. 
Version: 1
Author: Sakib Ahmed
Author URI: 
*/
  
function hotel_info_ajaxinsert()
	{
		global $wpdb;

		/* function kv_handle_attachment($file_handler, $post_id, $set_thu = false)
		{
			// check to make sure its a successful upload
			if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

			require_once(ABSPATH . "wp-admin" . '/includes/image.php');
			require_once(ABSPATH . "wp-admin" . '/includes/file.php');
			require_once(ABSPATH . "wp-admin" . '/includes/media.php');

			$attach_id = media_handle_upload($file_handler, $post_id);
			var_dump($attach_id);
			return $attach_id;
		} */
	
	 	//Just uploading photo or attachments
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		require_once(ABSPATH . "wp-admin" . '/includes/media.php');
		 
		$file_handler = 'image01'; //Form attachment Field name.
		$attach_id1 = media_handle_upload( $file_handler, $post_id );
		echo $attach_id1;
		
		$file_handler = 'image02'; //Form attachment Field name.
		$attach_id2 = media_handle_upload( $file_handler, $post_id );
		echo $attach_id2;
		
		$file_handler = 'image03'; //Form attachment Field name.
		$attach_id3 = media_handle_upload( $file_handler, $post_id );
		echo $attach_id3;



	 
	

		
		global $wpdb;
			$sql = $wpdb->insert(
			'hotels', //table
				array(
				'image_1' 		=> $attach_id1,
				'image_2' 		=> $attach_id2,
				'image_3' 		=> $attach_id3) 
				//array('%s', '%s') //data format
				);
			if($sql){
				echo "Data Inserted";
			}else{
				echo "Not Inserted";
			}
			$message.="Data inserted";
		
		/*  if( 'POST' == $_SERVER['REQUEST_METHOD']  ) {
			if ( $_FILES ) { 
				$files = $_FILES["kv_multiple_attachments"];  
				foreach ($files['name'] as $key => $value) { 			
					if ($files['name'][$key]) { 
						$file = array( 
							'name' => $files['name'][$key],
							'type' => $files['type'][$key], 
							'tmp_name' => $files['tmp_name'][$key], 
							'error' => $files['error'][$key],
							'size' => $files['size'][$key]
						); 
						//var_dump($file);
						$_FILES = array ("kv_multiple_attachments" => $file); 
						
						//foreach ($_FILES as $file => $array) {				
							$newupload = kv_handle_attachment($file,$pid); 
						//}
					} 
				} 
			}
		}  */
		
		
		
		
		
	/* // Check that the nonce is valid, and the user can edit this post.
	if ( 
	isset( $_POST['my_image_upload_nonce'], $_POST['post_id'] ) 
	&& wp_verify_nonce( $_POST['my_image_upload_nonce'], 'my_image_upload' )
	&& current_user_can( 'edit_post', $_POST['post_id'] )
	){
	echo $aaa = $_POST['post_id'];
	// The nonce was valid and the user has the capabilities, it is safe to continue.

	// These files need to be included as dependencies when on the front end.
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );

	// Let WordPress handle the upload.
	// Remember, 'my_image_upload' is the name of our file input in our form above.
	$attachment_id = media_handle_upload( 'my_image_upload', $_POST['post_id'] );

	if ( is_wp_error( $attachment_id ) ) {
	// There was an error uploading the image.
	} else {
	// The image was uploaded successfully!
	}

	} else {

	// The security check failed, maybe show the user an error.
	}
	//var_dump($attachment_id);
 $attachmentid = $attachment_id;
	 */
	
			
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		global $wpdb;
		$county 		= $_POST["county"];
		//var_dump($county );
		$hotel_name 	= $_POST["hotel_name"];
		
		//$image_1 		= ($_FILES["image_1"]["tmp_name"]);
		
		$image 				= ($_FILES["image_1"]["name"]);
		$theme_image 		= ($_FILES["image_1"]["tmp_name"]);
		$image_info 		= getimagesize($_FILES["image_1"]["tmp_name"]);

		$bin_string 		= file_get_contents("$theme_image"); 
		$theme_image_enc 	= base64_encode($bin_string); 


		$org_w  = $image_info[0]; // current width as found in image file
		$org_h = $image_info[1]; // current height as found in image file
			
		$WIDTH 		= 900; // The size of your new image
		$HEIGHT		= 600;  // The size of your new image


		$theme_image_little 	= imagecreatefromstring(base64_decode($theme_image_enc));
		$image_little 			= imagecreatetruecolor($WIDTH, $HEIGHT);
		imagecopyresampled($image_little, $theme_image_little, 0, 0, 0, 0, $WIDTH, $HEIGHT, $org_w, $org_h);


		ImageJPEG($image_little , $image, 5); 
		ob_start();
		imagepng($image_little);
		$contents =  ob_get_contents();
		//var_dump($contents);
		ob_end_clean();

		$aencode1 = base64_encode($contents);
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		$image_2 		= ($_FILES["image_2"]["tmp_name"]);
		$image_3 		= ($_FILES["image_3"]["tmp_name"]);
		
		
		$image_4 		= ($_FILES["image_4"]["tmp_name"]);
		$image_5 		= ($_FILES["image_5"]["tmp_name"]);
		$image_6 		= ($_FILES["image_6"]["tmp_name"]);
		$image_7 		= ($_FILES["image_7"]["tmp_name"]);
		$image_8 		= ($_FILES["image_8"]["tmp_name"]);
		
		
		
		
		
		
		
		
		
		
		
		
		$kids_des 		= $_POST["kids_des"];
		$adults_des 	= $_POST["adults_des"];
		$hotel_des 		= $_POST["hotel_des"];
		$lat 			= $_POST["lat"];
		$lang 			= $_POST["lang"];
				
			//	var_dump($hotel_des );


		//image 1
		//$bin_string_1 = file_get_contents("$image_1"); 
		//$aencode1 = base64_encode($bin_string_1);
		//var_dump($aencode1);
		//image 2
		$bin_string_2 = file_get_contents("$image_2"); 
		$aencode2 = base64_encode($bin_string_2);
		//var_dump($aencode2);
		//image 3
		$bin_string_3 = file_get_contents("$image_3"); 
		$aencode3 = base64_encode($bin_string_3);
		//var_dump($aencode3);
		
		
		
		
		//image 4
		$bin_string_4 = file_get_contents("$image_4"); 
		$aencode4 = base64_encode($bin_string_4);
		//var_dump($aencode3);
		//image 5
		$bin_string_5 = file_get_contents("$image_5"); 
		$aencode5 = base64_encode($bin_string_5);
		//var_dump($aencode3);
		//image 6
		$bin_string_6 = file_get_contents("$image_6"); 
		$aencode6 = base64_encode($bin_string_6);
		//var_dump($aencode3);
		//image 7
		$bin_string_7 = file_get_contents("$image_7"); 
		$aencode7 = base64_encode($bin_string_7);
		//var_dump($aencode3);
		//image 8
		$bin_string_8 = file_get_contents("$image_8"); 
		$aencode8 = base64_encode($bin_string_8);
		//var_dump($aencode3);

		
		
		
		
		
		
		
		
		
		
		
		
		$wpdb->insert(
			'hotels', //table
			array(
			'county' 		=> $county,
			'hotel' 		=> $hotel_name,
			'image_1' 		=> $aencode1,
			'image_2' 		=> $aencode2,
			'image_3' 		=> $aencode3,
			'image_4' 		=> $aencode4,
			'image_5' 		=> $aencode5,
			'image_6' 		=> $aencode6,
			'image_7' 		=> $aencode7,
			'image_8' 		=> $aencode8,
			'kids' 			=> $kids_des,
			'adult' 		=> $adults_des, 
			'description' 	=> $hotel_des,
			'lat' 			=> $lat,
			'lang' 			=> $lang) 
		  //array('%s', '%s') //data format
		);
		$message.="Data inserted";
	}


	add_action( 'wp_ajax_hotel_info_ajaxinsert', 'hotel_info_ajaxinsert' );
	add_action('wp_ajax_nopriv_hotel_info_ajaxinsert', 'hotel_info_ajaxinsert');

	


//////////////////AJAX UPDATE/////////////////////////
 function hotel_info_ajaxupdate()
	{
		global $wpdb;
		$table_name = "hotels";
		
		$id 			= $_POST["id"];
		$county 		= $_POST["county"];
		$hotel_name 	= $_POST["hotel_name"];
		$image_1 		= ($_FILES["image_1"]["tmp_name"]);
		$image_2 		= ($_FILES["image_2"]["tmp_name"]);
		$image_3 		= ($_FILES["image_3"]["tmp_name"]);
		$image_4 		= ($_FILES["image_4"]["tmp_name"]);
		$image_5 		= ($_FILES["image_5"]["tmp_name"]);
		$image_6 		= ($_FILES["image_6"]["tmp_name"]);
		$image_7 		= ($_FILES["image_7"]["tmp_name"]);
		$image_8 		= ($_FILES["image_8"]["tmp_name"]);
		$kids_des 		= $_POST["kids_desu"];
		$adults_des 	= $_POST["adults_desu"];
		$hotel_des 		= $_POST["hotel_desu"];
		$lat 			= $_POST["lat"];
		$lang 			= $_POST["lang"];
		var_dump($kids_des);
		var_dump($adults_des);
		var_dump($hotel_des);
		
		//image 1
		$bin_string_1 = file_get_contents("$image_1"); 
		$aencode1 = base64_encode($bin_string_1);
		var_dump($aencode1);
		//image 1
		$bin_string_2 = file_get_contents("$image_2"); 
		$aencode2 = base64_encode($bin_string_2);
		var_dump($aencode2);
		//image 1
		$bin_string_3 = file_get_contents("$image_3"); 
		$aencode3 = base64_encode($bin_string_3);
		var_dump($aencode3);
		
		//image 4
		$bin_string_4 = file_get_contents("$image_4"); 
		$aencode4 = base64_encode($bin_string_4);
		//var_dump($aencode3);
		//image 5
		$bin_string_5 = file_get_contents("$image_5"); 
		$aencode5 = base64_encode($bin_string_5);
		//var_dump($aencode3);
		//image 6
		$bin_string_6 = file_get_contents("$image_6"); 
		$aencode6 = base64_encode($bin_string_6);
		//var_dump($aencode3);
		//image 7
		$bin_string_7 = file_get_contents("$image_7"); 
		$aencode7 = base64_encode($bin_string_7);
		//var_dump($aencode3);
		//image 8
		$bin_string_8 = file_get_contents("$image_8"); 
		$aencode8 = base64_encode($bin_string_8);
		//var_dump($aencode3);
			
		if(!empty($image_1 or $image_2 or $image_3)){
		//update with image
				$result = $wpdb->update(
						$table_name, //table
						array(
							'hotel' 		=> $hotel_name,
							'image_1' 		=> $aencode1,
							'image_2' 		=> $aencode2,
							'image_3' 		=> $aencode3,
							'image_4' 		=> $aencode4,
							'image_5' 		=> $aencode5,
							'image_6' 		=> $aencode6,
							'image_7' 		=> $aencode7,
							'image_8' 		=> $aencode8,
							'kids' 			=> $kids_des,
							'adult' 		=> $adults_des,
							'description' 	=> $hotel_des,
							'lat' 			=> $lat,
							'lang' 			=> $lang), //data
						array('id' => $id) //where

						);
		} 
		else {
		//update without image
				$result = $wpdb->update(
						$table_name, //table
						array(
							'hotel' 		=> $hotel_name,
							'kids' 			=> $kids_des,
							'adult' 		=> $adults_des,
							'description' 	=> $hotel_des,
							'lat' 			=> $lat,
							'lang' 			=> $lang), //data
						array('id' => $id) //where

						);
		}				
			
	}
	add_action( 'wp_ajax_hotel_info_ajaxupdate', 'hotel_info_ajaxupdate' );
	add_action('wp_ajax_nopriv_hotel_info_ajaxupdate', 'hotel_info_ajaxupdate'); 




////////////////////////////////////////////




//menu items
function hotel_info_wp_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('Hotel information plugin', //page title
	'Hotel Information', //menu title
	'manage_options', //capabilities
	'hotel_info_data_list', //menu slug
	'hotel_info_data_list', //function,
	'dashicons-building'//icon
	);
	
	//this is a submenu
	add_submenu_page('hotel_info_data_list', //parent slug
	'Add New Hotel Info ', //page title
	'Add New Hotel Info ', //menu title
	'manage_options', //capability
	'hotel_info_data_create', //menu slug
	'hotel_info_data_create'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Update', //page title
	'Update', //menu title
	'manage_options', //capability
	'hotel_info_data_update', //menu slug
	'hotel_info_data_update'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Delete', //page title
	'Delete', //menu title
	'manage_options', //capability
	'hotel_info_data_delete', //menu slug
	'hotel_info_data_delete'); //function
}
add_action('admin_menu','hotel_info_wp_modifymenu');



//add js and css//
function hotel_info_loadOurJsfile()
{
	
	wp_enqueue_script('demo-ajax', plugin_dir_url(__FILE__).'js/demo-ajax.js', array('jquery'), '1.0',TRUE);
	wp_enqueue_script('els-ajax-def', plugin_dir_url(__FILE__).'js/els-ajax-def.js', array('jquery'), '1.1', TRUE);
	wp_enqueue_script('bootstrap.min.js', plugin_dir_url(__FILE__).'js/bootstrap.min.js', array('jquery'), '1.1', TRUE);
	
	
	wp_enqueue_style('style', plugin_dir_url(__FILE__).'css/style.css', '', '1.1');
	wp_enqueue_style('bootstrap.min', plugin_dir_url(__FILE__).'css/bootstrap.min.css', '', '1.1');
	wp_enqueue_style('responsive.css', plugin_dir_url(__FILE__).'css/responsive.css', '', '1.1');
}
add_action('admin_enqueue_scripts', 'hotel_info_loadOurJsfile');


//add js and css end//

define('hotel_ROOTDIR', plugin_dir_path(__FILE__));
require_once(hotel_ROOTDIR . 'list.php');
require_once(hotel_ROOTDIR . 'create.php');
require_once(hotel_ROOTDIR . 'update.php');
require_once(hotel_ROOTDIR . 'delete.php');


require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');


 function hotel_info_limit($limit){
	$post_content= explode(" ", get_the_content());
	$less_content=array_slice($post_content,0,$limit);
  
	echo implode (" ",$less_content);
 }

 

?>