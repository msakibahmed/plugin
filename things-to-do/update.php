<?php

function things_data_update() {
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

	
    $table_name = "things_to_do";
    $id = $_GET["id"];
    $name = $_POST["name"];
    $code = $_POST["code"];
    $photo = $_POST["photo"];
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
	
	
	
	
        $schools = $wpdb->get_results($wpdb->prepare("SELECT id,things_1,things_2,things_3,things_4,things_5,county from $table_name where id=%s", $id));
		//var_dump($schools);
        foreach ($schools as $s) {
            $things_1 = $s->things_1;
            $things_2 = $s->things_2;
            $things_3 = $s->things_3;
            $things_4 = $s->things_4;
            $things_5 = $s->things_5;
            $county	  = $s->county;
        }
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>mywp/sinetiks-schools/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Update Things Information</h2>

        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=thingsdatalist') ?>">&laquo; Back to schools list</a>

        <?php } else if ($_POST['update']) { ?>
            <div class="updated"><p>updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=thingsdatalist') ?>">&laquo; Back to schools list</a>

        <?php } else { ?>
            <form id="ajax_form_update"  method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
                <table class='wp-list-table widefat fixed mytableu'>
                    <tr><th></th><td><input type="hidden" name="id" value="<?php echo $id; ?>"/></td></tr>
                    <tr><th>Things 1</th><td><input type="text" name="things_1" value="<?php echo $things_1; ?>"/></td></tr>
                    <tr><th>Things 2</th><td><input type="text" name="things_2" value="<?php echo $things_2; ?>"/></td></tr>
                    <tr><th>Things 3</th><td><input type="text" name="things_3" value="<?php echo $things_3; ?>"/></td></tr>
                    <tr><th>Things 4</th><td><input type="text" name="things_4" value="<?php echo $things_4; ?>"/></td></tr>
                    <tr><th>Things 5</th><td><input type="text" name="things_5" value="<?php echo $things_5; ?>"/></td></tr>
                    <tr><th>County</th>
							<td>
								<select type="text" name="county" id="country"  value="<?php echo $county; ?> class="ss-field-width">
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
				url: "/blue_bucket/wp-admin/admin-ajax.php?action=things_ajaxupdate",  
				type: request_method,
				data : form_data,
				contentType: false,
				cache: false,
				processData:false,
				success:function(data)
				{  
				alert ('Data Updated');
				top.location.href="admin.php?page=thingsdatalist";
				},
			})
		});
	</script>
    <?php
}