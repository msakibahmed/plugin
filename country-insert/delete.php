<?php


function data_delete() {
    global $wpdb;
    $table_name = "countries";
    $id = $_GET["id"];
    //$name = $_POST["name"];

//delete
    if($wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id))===TRUE)
	{
	 
	   wp_redirect( 'admin.php?page=data_list', 301 ); exit; 
	}
	else
	{
		echo "<script type='text/javascript'>confirm('Are you sure delete your data?');</script>";
	}
 /* if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));
    } */
    ?>
    <!--
        <?php if ($_POST['delete'])  ?>
            <div class="updated"><p>School deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=data_list') ?>">&laquo; Back to schools list</a>
        
		-->
		
		
		<script>
	
		
	
		jQuery(document).ready(function(){
			//jQuery(location).attr('href','select.php')
			top.location.href="admin.php?page=data_list";
		})

	</script>
		
		
		
    <?php
}