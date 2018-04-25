<?php

function reviews_data_update() {
$image_show = wp_upload_dir()['baseurl']; // wp_upload_dir has diffrent types of array I am used 'baseurl' for path
	
	
	$imagesss = ($_FILES["photo"]["tmp_name"]);
    
	$myimge = basename($_FILES["photo"]["name"]);



	global $wpdb;
	$table_name = $wpdb->prefix . "school";
	$path_array = wp_upload_dir(); // normal format start
	$file_name = pathinfo($myimge,PATHINFO_FILENAME).time().".".pathinfo($myimge,PATHINFO_EXTENSION);
	$imgtype     =   strtolower(pathinfo($imagesss,PATHINFO_EXTENSION));    
	$targetpath        =   $path_array["path"]."/".$file_name;
	//var_dump($targetpath);

	move_uploaded_file($imagesss, $targetpath );

	
    $table_name = "reviews";
    $id = $_GET["id"];
	
	echo $id;
   
//update
    if (isset($_POST['update'])) {
      $wpdb->update(
                $table_name, //table
                array('code' => $code, 'name' => $name,'image_name'=>$file_name ), //data
                array('id' => $id) //where
               // array('%s'), //data format
                //array('%s') //where format
        );
		
    }
//delete
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = $id"));
    } else {//selecting value to update	
	
	
	

        $schools = $wpdb->get_results($wpdb->prepare("SELECT id,hotel_id,rating from $table_name where id=%s", $id));
		//var_dump($schools);
		
		$rows = $wpdb->get_results( 
		"SELECT hotels.hotel,reviews.hotel_id,reviews.id 
		FROM hotels 
		INNER JOIN reviews ON hotels.id = reviews.hotel_id
		WHERE reviews.id = $id" );
		var_dump($rows);
		echo $rows[0]->hotel;
		
		
        foreach ($schools as $s) {
            $hotel_id = $s->hotel_id;
            $rating = $s->rating;
        }
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>mywp/sinetiks-schools/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Update Reviews Information</h2>

        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=reviews_data_list') ?>">&laquo; Back to schools list</a>

        <?php } else if ($_POST['update']) { ?>
            <div class="updated"><p>updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=reviews_data_list') ?>">&laquo; Back to schools list</a>

        <?php } else { ?>
            <form id="ajax_form_update"  method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
                <table class='wp-list-table widefat fixed mytableu'>
                    <tr><th></th><td><input type="hidden" name="id" value="<?php echo $id; ?>"/></td></tr>
                    
					<tr><th>Rating</th><td>
						<span class="star-rating">
						  <input type="radio" name="rating" value="1"><i></i>
						  <input type="radio" name="rating" value="2"><i></i>
						  <input type="radio" name="rating" value="3"><i></i>
						  <input type="radio" name="rating" value="4"><i></i>
						  <input type="radio" name="rating" value="5"><i></i>
						</span>
						<strong class="choice">Choose a rating</strong>
					</td></tr>
               
                    <tr><th>Hotel Id</th>
							<td>
								<select type="text" name="hotel_id" id="hotel_id" class="ss-field-width">
									<option value="<?php echo $rows[0]->id; ?>"><?php echo $rows[0]->hotel; ?></option>'
									<?php
										global $wpdb;
										$table_name ="hotels";
										$rows = $wpdb->get_results( "SELECT id, hotel from $table_name " );


										foreach ($rows as $row) 
										{ 
											echo '<option value='.$row->id.'>'.$row->hotel.'</option>';
										}
									?>
								</select>
							</td>
					</tr>
					
                </table>
                <input type='submit' class="btn btn-primary" name="submit" value='Update' class='button'> &nbsp;&nbsp;
            </form>
        <?php } ?>

    </div>
		<script>
		//Image on change with ajax for update
		 function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    jQuery('#blah')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
		/////////////////END////////////////////
		
		jQuery("#ajax_form_update").submit(function(event){
			event.preventDefault(); //prevent default action
			var post_url = jQuery(this).attr("action"); //get form action url
			var request_method = jQuery(this).attr("method"); //get form GET/POST method
			var form_data = new FormData(this); //Creates new FormData object
			jQuery.ajax({
				url: "/blue_bucket/wp-admin/admin-ajax.php?action=reviews_ajaxupdate",  
				type: request_method,
				data : form_data,
				contentType: false,
				cache: false,
				processData:false,
				success:function(data)
				{  
				alert ('Data Updated');
				top.location.href="admin.php?page=reviews_data_list";
				},
			})
		});
	</script>
    <?php
}