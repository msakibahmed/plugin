
<?php

function reviews_data_create() {
   
		
		//var_dump($rows);
        //$rowcount = $wpdb->num_rows;
		
    ?>
 <?php
global $wpdb;
$table_name ="hotels";
$rows = $wpdb->get_results( "SELECT id, hotel from $table_name " );
?>


    <div class="wrap ">
        <h2>Reviews and Ratings</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
		
		
        <form  id="my_form" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?> " enctype="multipart/form-data">
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">Reviews</th>
					<td>
						<span class="star-rating">
						  <input type="radio" name="rating" value="1" required><i></i>
						  <input type="radio" name="rating" value="2" required><i></i>
						  <input type="radio" name="rating" value="3" required><i></i>
						  <input type="radio" name="rating" value="4" required><i></i>
						  <input type="radio" name="rating" value="5" required><i></i>
						</span>
						<strong class="choice">Choose a rating</strong>
					</td>
                </tr>
				

				<tr>
                    <th class="ss-th-width">Hotel Id</th>
                     <td>
						<select type="text" name="hotel_id" id="hotel_id"  class="ss-field-width">
							<?php
							foreach ($rows as $row) 
							{ 
							echo '<option value='.$row->id.'>'.$row->hotel.'</option>';
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
         url: "/blue_bucket/wp-admin/admin-ajax.php?action=reviews_ajaxinsert",  

        type: request_method,
        data : form_data,
        contentType: false,
        cache: false,
        processData:false,
		success:function(data){  
		alert ('Data Successfully Inserted');
		//location.reload();
		top.location.href="admin.php?page=reviews_data_list";
		},
		 
		

    })
	
});		
////Insert END////



	</script>
	<script>
	jQuery(':radio').change(
	  function(){
		jQuery('.choice').text( this.value + ' stars' );
	  } 
	)
	</script>
	
   <?php




}
