
<?php

function hotel_info_data_create() {
global $wpdb;
$table_name ="countries";
$rows = $wpdb->get_results( "SELECT county from $table_name " );
?>


    <!--<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>mywp/sinetiks-schools/style-admin.css" rel="stylesheet" />-->
    <div class="wrap ">
        <h2>Insert Hotel</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>

		
        <form  id="my_form" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?> " enctype="multipart/form-data">
            <table class='wp-list-table widefat fixed'>
               <tr>
                    <th class="ss-th-width">County</th>
                     <td>
						<select type="text" name="county" id="county"  class="ss-field-width">
							<?php
							foreach ($rows as $row) 
							{ 
							echo '<option>'.$row->county.'</option>';
							}
							?>
						</select>				
					</td>
                </tr>
				<tr>
                    <th class="ss-th-width">Hotel Name</th>
                    <td><input type="text" name="hotel_name" class="ss-field-width" /></td>
                </tr>
				<tr>
					<th class="ss-th-width">Image 1</th>
					<td>
						<img id="imageshow1" class="img-responsive" />
						<input  type="file" onchange="readURL1(this);" name="image_1"/>  
					</td>					
				</tr>
				<tr>
					<th class="ss-th-width">Image 2</th>
					<td>
						<img id="imageshow2" class="img-responsive" />
						<input  type="file" onchange="readURL2(this);" name="image_2"/>  
					</td>					
				</tr>
				<tr>
					<th class="ss-th-width">Image 3</th>
					<td>
						<img id="imageshow3" class="img-responsive" />
						<input  type="file" onchange="readURL3(this);" name="image_3"/>  
					</td>					
				</tr>
				
				
				
				
				
				
				
				<tr>
					<th class="ss-th-width">Image 4</th>
					<td>
						<img id="imageshow4" class="img-responsive" />
						<input  type="file" onchange="readURL4(this);" name="image_4"/>  
					</td>					
				</tr>
				<tr>
					<th class="ss-th-width">Image 5</th>
					<td>
						<img id="imageshow5" class="img-responsive" />
						<input  type="file" onchange="readURL5(this);" name="image_5"/>  
					</td>					
				</tr>
				<tr>
					<th class="ss-th-width">Image 6</th>
					<td>
						<img id="imageshow6" class="img-responsive" />
						<input  type="file" onchange="readURL6(this);" name="image_6"/>  
					</td>					
				</tr>
				<tr>
					<th class="ss-th-width">Image 7</th>
					<td>
						<img id="imageshow7" class="img-responsive" />
						<input  type="file" onchange="readURL7(this);" name="image_7"/>  
					</td>					
				</tr>
				<tr>
					<th class="ss-th-width">Image 8</th>
					<td>
						<img id="imageshow8" class="img-responsive" />
						<input  type="file" onchange="readURL8(this);" name="image_8"/>  
					</td>					
				</tr>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				<tr>
                    <th class="ss-th-width">Kids</th>
					<td>
						<?php
							$content = '';
							$editor_id1 = 'kidsdesid';
							wp_editor( $content, $editor_id1, 
								array(
									textarea_name =>  'kids_des',
									textarea_rows => 5,
								)  
							);
						?>
					</td>
                </tr>
				<tr>
                    <th class="ss-th-width">Adult</th>
					<td>
						<?php
							$content = '';
							$editor_id2 = 'adultdesid';
							wp_editor( $content, $editor_id2, 
								array(
									textarea_name =>  'adults_des',
									textarea_rows => 5,
								)  
							);
						?>
					</td>
                </tr>
				<tr>
					<th class="ss-th-width">Descriptions</th>
                    <td>
						<?php
							$content = '';
							$editor_id3 = 'hoteldesid';
							wp_editor( $content, $editor_id3, 
								array(
									textarea_name =>  'hotel_des',
									textarea_rows => 5,
								)  
							);
						?>
					</td>
                </tr>
				<tr>
                    <th class="ss-th-width">Lat</th>
                    <td><input type="text" name="lat" class="ss-field-width" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Lang</th>
                    <td><input type="text" name="lang" class="ss-field-width" /></td>
                </tr>
				

				
            </table>
            <input  class="btn btn-success" type='submit' id="uploadbutton" name="insert" value='Save' class='button'>

        </form>
    </div>


	<script>


	
	
	
	
	//Insert////
jQuery("#my_form").submit(function(event){
    event.preventDefault(); //prevent default action
    var post_url = jQuery(this).attr("action"); //get form action url
    var request_method = jQuery(this).attr("method"); //get form GET/POST method
    var form_data = new FormData(this); //Creates new FormData object
    jQuery.ajax({
         url: "/blue_bucket/wp-admin/admin-ajax.php?action=hotel_info_ajaxinsert",  

        type: request_method,
        data : form_data,
        contentType: false,
        cache: false,
        processData:false,
		success:function(data){  
		alert ('Data Successfully Inserted');
		//location.reload();
		//top.location.href="admin.php?page=hotel_info_data_list";
		},
		 
		

    })
	
});		
////Insert END////

//Image on change with ajax for update
 function readURL1(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			jQuery('#imageshow1')
				.show()
				.attr('src', e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
}
 function readURL2(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			jQuery('#imageshow2')
				.show()
				.attr('src', e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
}
 function readURL3(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			jQuery('#imageshow3')
				.show()
				.attr('src', e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
}





 function readURL4(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			jQuery('#imageshow4')
				.show()
				.attr('src', e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
}
 function readURL5(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			jQuery('#imageshow5')
				.show()
				.attr('src', e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
}
 function readURL6(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			jQuery('#imageshow6')
				.show()
				.attr('src', e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
}
 function readURL7(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			jQuery('#imageshow7')
				.show()
				.attr('src', e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
}
 function readURL8(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			jQuery('#imageshow8')
				.show()
				.attr('src', e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
}
/////////////////END////////////////////
	</script>
	
   <?php




}
