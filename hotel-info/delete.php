<?php


function hotel_info_data_delete() {
    global $wpdb;
    $table_name = "hotels";
    $id = $_GET["id"];

//delete
    if($wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id))===TRUE)
	{
	 
	   wp_redirect( 'admin.php?page=hotel_info_data_list', 301 ); exit; 
	}
	else
	{
		echo "<script type='text/javascript'>confirm('Are you sure delete your data?');</script>";
	}

    ?>
    <!--
        <?php if ($_POST['delete'])  ?>
            <a href="<?php echo admin_url('admin.php?page=hotel_info_data_list') ?>">&laquo; Back to schools list</a>
        
		-->
		
		
		<script>
	
		
	
		jQuery(document).ready(function(){
			//jQuery(location).attr('href','select.php')
			top.location.href="admin.php?page=hotel_info_data_list";
		})

	</script>
		
		
		
    <?php
}