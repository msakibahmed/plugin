
<?php

function data_create() {
   
    ?>


    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>mywp/sinetiks-schools/style-admin.css" rel="stylesheet" />
    <div class="plugin_insert_form">
        <h2>Insert Hotel Name</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
		
		
        <form  id="my_form" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?> " enctype="multipart/form-data">
            <table class='wp-list-table widefat fixed '>
                <tr>
                    <th class="ss-th-width">County Name</th>
                    <td><input type="text" name="countyname" value="<?php echo $code; ?>" class="ss-field-width" /></td>
                </tr>
				<tr> 
					<th class="ss-th-width">County Flag</th>
					<td>
						<img id="imageshow" class="img-responsive" />
						<input  type="file" onchange="readURL(this);" name="county-flag"  />
					</td>
				</tr>
				<tr>
                    <th class="ss-th-width">Lat</th>
                    <td><input type="text" name="lat" value="<?php echo $code; ?>" class="ss-field-width" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Lang</th>
                    <td><input type="text" name="lang" value="<?php echo $code; ?>" class="ss-field-width" /></td>
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
         url: "/blue_bucket/wp-admin/admin-ajax.php?action=ajaxinsert",  

        type: request_method,
        data : form_data,
        contentType: false,
        cache: false,
        processData:false,
		success:function(data){  
		alert ('Data Successfully Inserted');
		//location.reload();
		top.location.href="admin.php?page=data_list";
		},
		 
		

    })
	
});		
////Insert END////


//Image on change with ajax for update
		 function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    jQuery('#imageshow')
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
