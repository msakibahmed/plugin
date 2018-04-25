<?php

function hotel_info_data_update() {
	
	global $wpdb;
	$table_name = $wpdb->prefix . "hotels";
	$path_array = wp_upload_dir(); // normal format start
	$file_name = pathinfo($myimge,PATHINFO_FILENAME).time().".".pathinfo($myimge,PATHINFO_EXTENSION);
	$imgtype     =   strtolower(pathinfo($imagesss,PATHINFO_EXTENSION));    
	$targetpath        =   $path_array["path"]."/".$file_name;
	//var_dump($targetpath);

	move_uploaded_file($imagesss, $targetpath );

    $table_name = "hotels";
    $id = $_GET["id"];
   
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
	
        $rows = $wpdb->get_results($wpdb->prepare("SELECT * from $table_name where id=%s", $id));
		//var_dump($schools);
        foreach ($rows as $s) {
            $county 	= $s->county;
            $hotel 		= $s->hotel;
            $image_1 	= $s->image_1;
            $image_2 	= $s->image_2;
            $image_3 	= $s->image_3;
            $image_4 	= $s->image_4;
            $image_5 	= $s->image_5;
            $image_6 	= $s->image_6;
            $image_7 	= $s->image_7;
            $image_8 	= $s->image_8;
            $kids 		= $s->kids;
            $adult	  	= $s->adult;
            $description 	= $s->description;
            $lat		= $s->lat;
            $lang 		= $s->lang;
        }
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>mywp/sinetiks-schools/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Update Hotel Information</h2>

        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=hotel_info_data_list') ?>">&laquo; Back to schools list</a>

        <?php } else if ($_POST['update']) { ?>
            <div class="updated"><p>updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=hotel_info_data_list') ?>">&laquo; Back to schools list</a>

        <?php } else { ?>
            <form id="ajax_form_update"  method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
                <table class='wp-list-table widefat fixed mytableu'>
                    <tr><th></th><td><input type="hidden" name="id" value="<?php echo $id; ?>"/></td></tr>
                    <tr><th>County</th>
							<td>
								<select type="text" name="county" id="county"  value="<?php echo $county; ?> class="ss-field-width">
									<option><?php echo $county; ?></option>'
									<?php
										global $wpdb;
										$table_name ="countries";
										$rows = $wpdb->get_results( "SELECT county from $table_name " );
										foreach ($rows as $row) 
										{ 
										echo '<option>'.$row->county.'</option>';
										}
									?>
								</select>
							</td>
					</tr>
					<tr><th>Hotel Name</th><td><input type="text" name="hotel_name" value="<?php echo $hotel; ?>"/></td></tr>
					<tr>
						<th>Images</th><td >
						<img id="image1" src="data:image/jpeg;base64, <?php echo  $image_1;?>"  class="img-responsive" /> 
						<input  type="file" onchange="readURL1(this);" name="image_1"  value="<?php echo $photo; ?>" class="ss-field-width" />
						<img id="image2" src="data:image/jpeg;base64, <?php echo  $image_2;?>"  class="img-responsive" />
						<input  type="file" onchange="readURL2(this);" name="image_2"  value="<?php echo $photo; ?>" class="ss-field-width" />
						<img id="image3" src="data:image/jpeg;base64, <?php echo  $image_3;?>"  class="img-responsive" />
						<input  type="file" onchange="readURL3(this);" name="image_3"  value="<?php echo $photo; ?>" class="ss-field-width" />
						
						<img id="image4" src="data:image/jpeg;base64, <?php echo  $image_4;?>"  class="img-responsive" />
						<input  type="file" onchange="readURL4(this);" name="image_4"  value="<?php echo $photo; ?>" class="ss-field-width" />
						<img id="image5" src="data:image/jpeg;base64, <?php echo  $image_5;?>"  class="img-responsive" />
						<input  type="file" onchange="readURL5(this);" name="image_5"  value="<?php echo $photo; ?>" class="ss-field-width" />
						<img id="image6" src="data:image/jpeg;base64, <?php echo  $image_6;?>"  class="img-responsive" />
						<input  type="file" onchange="readURL6(this);" name="image_6"  value="<?php echo $photo; ?>" class="ss-field-width" />
						<img id="image7" src="data:image/jpeg;base64, <?php echo  $image_7;?>"  class="img-responsive" />
						<input  type="file" onchange="readURL7(this);" name="image_7"  value="<?php echo $photo; ?>" class="ss-field-width" />
						<img id="image8" src="data:image/jpeg;base64, <?php echo  $image_8;?>"  class="img-responsive" />
						<input  type="file" onchange="readURL8(this);" name="image_8"  value="<?php echo $photo; ?>" class="ss-field-width" />
						</td>
					</tr>
		
					
                    <tr><th>Kids Information:</th>
						<td>
							<?php
								$content1 = $kids;
								$editor_idu1 = 'kidsdesidu';
								wp_editor( $content1, $editor_idu1, 
									array(
										textarea_name =>  'kids_desu',
										textarea_rows => 5,
									)  
								); 
							?>
						</td>
					</tr>
                    <tr><th>Adults Information:</th>
						<td>
							<?php
								$content2 = $adult;
								$editor_idu2 = 'adultdesidu';
								wp_editor( $content2, $editor_idu2, 
									array(
										textarea_name =>  'adults_desu',
										textarea_rows => 5,
									)  
								); 
							?>
						</td>
					</tr>
					
                    <tr><th>Description:</th>
						<td>
							<?php
							$content3 = $description;
							$editor_idu3 = 'hoteldesidu';
							wp_editor( $content3, $editor_idu3, 
								array(
									textarea_name =>  'hotel_desu',
									textarea_rows => 5,
								)  
							); 
						?>
						</td>
					</tr>
					<tr>
						<th class="ss-th-width">Hotel Lat:</th>
						<td><input type="text" name="lat" class="ss-field-width" value="<?php echo $lat; ?>"/></td>
					</tr>
					<tr>
						<th class="ss-th-width">Hotel Lang:</th>
						<td><input type="text" name="lang" class="ss-field-width" value="<?php echo $lang; ?>"/></td>
					</tr>
                   
					
                </table>
                <input type='submit' class="btn btn-primary" name="submit" value='Update' class='button'> &nbsp;&nbsp;
            </form>
        <?php } ?>

    </div>
		<script>
		
		
		jQuery("#ajax_form_update").submit(function(event){
			event.preventDefault(); //prevent default action
			var post_url = jQuery(this).attr("action"); //get form action url
			var request_method = jQuery(this).attr("method"); //get form GET/POST method
			var form_data = new FormData(this); //Creates new FormData object
			jQuery.ajax({
				url: "/blue_bucket/wp-admin/admin-ajax.php?action=hotel_info_ajaxupdate",  
				type: request_method,
				data : form_data,
				contentType: false,
				cache: false,
				processData:false,
				success:function(data)
				{  
				alert ('Data Updated');
				//top.location.href="admin.php?page=hotel_info_data_list";
				},
			})
		});
		
		//Image on change with ajax for update
		function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    jQuery('#image1')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
		function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    jQuery('#image2')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
		function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    jQuery('#image3')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
		
		
		
		
		
		function readURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    jQuery('#image4')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
		function readURL5(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    jQuery('#image5')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
		function readURL6(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    jQuery('#image6')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
		function readURL7(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    jQuery('#image7')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
		function readURL8(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    jQuery('#image8')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
		
		
		
		
		

		/////////////////END////////////////////
	</script>
    <?php
}