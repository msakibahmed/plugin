
<?php

function things_data_create() {
global $wpdb;
$table_name ="countries";
$rows = $wpdb->get_results( "SELECT county from $table_name " );
?>


    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>mywp/sinetiks-schools/style-admin.css" rel="stylesheet" />
    <div class="wrap ">
        <h2>Insert Things to do</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
		
		
        <form  id="my_form" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?> " enctype="multipart/form-data">
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">Things 1</th>
                    <td><input type="text" name="thnigs1" value="<?php echo $code; ?>" class="ss-field-width" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Things 2</th>
                    <td><input type="text" name="thnigs2" value="<?php echo $code; ?>" class="ss-field-width" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Things 3</th>
                    <td><input type="text" name="thnigs3" value="<?php echo $code; ?>" class="ss-field-width" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Things 4</th>
                    <td><input type="text" name="thnigs4" value="<?php echo $code; ?>" class="ss-field-width" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Things 5</th>
					<td><input type="text" name="thnigs5" value="<?php echo $code; ?>" class="ss-field-width" /></td>
                </tr>

				<tr>
                    <th class="ss-th-width">County</th>
                     <td>
						<select type="text" name="things_county" id="country"  class="ss-field-width">
							<?php
							foreach ($rows as $row) 
							{ 
							echo '<option>'.$row->county.'</option>';
							}
							?>
						</select>				
					</td>
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
         url: "/blue_bucket/wp-admin/admin-ajax.php?action=things_ajaxinsert",  

        type: request_method,
        data : form_data,
        contentType: false,
        cache: false,
        processData:false,
		success:function(data){  
		alert ('Data Successfully Inserted');
		//location.reload();
		//top.location.href="admin.php?page=thingsdatalist";
		},
		 
		

    })
	
});		
////Insert END////



	</script>
	<script>
	 // jQuery(document).ready(function(){  
	  // jQuery('#country').keyup(function(){  
		   // var query = jQuery(this).val();  
		   // if(query != '')  
		   // {  
				// jQuery.ajax({  
					 // url:"search.php",  
					 // method:"POST",  
					 // data:{query:query},  
					 // success:function(data)  
					 // {  
						  // jQuery('#countryList').fadeIn();  
						  // jQuery('#countryList').html(data);  
					 // }  
				// });  
		   // }  
	  // });  
	  // jQuery(document).on('click', 'li', function(){  
		   // jQuery('#country').val($(this).text());  
		   // jQuery('#countryList').fadeOut();  
	  // });  
	  // jQuery(document).on('click', 'body', function(){  
		   // jQuery('#countryList').fadeOut();  
	  // });
	 // });
	</script>
	
   <?php




}
