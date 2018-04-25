<?php

    function data_list() {
        global $wpdb;
        $table_name ="countries";

        $pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;      

        $limit = 15; // number of rows in page
        $offset = ( $pagenum - 1 ) * $limit;
        $total = $wpdb->get_var( "select count(*) as total from $table_name" );
        $num_of_pages = ceil( $total / $limit );

        $rows = $wpdb->get_results( "SELECT id,county,flag,lat,lang from $table_name limit  $offset, $limit" );
		//var_dump($rows);
        $rowcount = $wpdb->num_rows;

    ?>
       <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>mywp/sinetiks-schools/style-admin.css" rel="stylesheet" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div class="wrap abs insertdata">
        <h2>County List</h2>
        <?php $path_array = wp_upload_dir()['baseurl']; // wp_upload_dir has diffrent types of array I am used 'baseurl' for path ?>
		<table id="miyazaki" class="table-striped table-hover col-sm-12">
			<thead>
			<tr>
				<th>ID</th><th>County</th><th>Flag</th><th>Lat</th><th>Lang</th>
			</tr>
			<tbody>
			<?php
				if($rowcount>0)
				{
					foreach ($rows as $row) 
					{ 
						?>
						<tr>
							<td class="manage-column ss-list-width"><?php echo $row->id ; ?> </td>
							<td class="manage-column ss-list-width"><?php echo $row->county; ?></td>
							<td><img src="data:image/jpeg;base64, <?php echo  $row->flag;?> " height="100px" width="100px" />  </td>
							<td class="manage-column ss-list-width"><?php echo $row->lat; ?></td>
							<td class="manage-column ss-list-width"><?php echo $row->lang; ?></td>
							<td class="respns"><a href="<?php echo admin_url('admin.php?page=data_update&id=' . $row->id); ?>"><button type="button" class="btn btn-primary">Update</button></a></a></td>
							<td class="respns"> 
							
							<input type='button' class="btn btn-danger delete_button" id="delete_button<?php echo $row->id;?>" value="delete" onclick="delete_row('<?php echo $row->id;?>');">
							
							
							
							</td>
							
							   
							   
							
							
						</tr>
						<?php 
					} 
				}
				else{
						echo "<tr><td cols=an='5'>No records found</td></tr>";
					} ?>
		</table>

			
		<div class="alignleft actions addbutton">
			<a href="<?php echo admin_url('admin.php?page=data_create'); ?>"><button type="button" class="btn btn-success">Add New</button></a></a>
		</div>
		<br class="clear">
	</div>	
<script type="text/javascript">	
//DELETE//
function delete_row(id)
{
	 if (confirm('Are you sure you want to delete this?')) {
		 jQuery.ajax({
			type:'post',
			url: "/blue_bucket/wp-admin/admin-ajax.php?action=delete_form",  
			data:{
					delete_row:'delete_row',
					row_id:id,
				},
			success:function(response) {
				if(response=="success")
					{
					var row=document.getElementById("row"+id);
					row.parentNode.removeChild(row);
					}
					top.location.href="admin.php?page=data_list";
			}
		 });
	 }
}

</script>
	
	
	
	
		<!--	Pagination Strat -->
		<?php

		$page_links = paginate_links( array(
			'base' => add_query_arg( 'pagenum', '%#%' ),
			'format' => '',
			'prev_text' => __( '&laquo;', 'text-domain' ),
			'next_text' => __( '&raquo;', 'text-domain' ),
			'total' => $num_of_pages,
			'current' => $pagenum
		) );

		if ( $page_links ) {
			echo '<div class="tablenav" style="width: 99%;"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
		}
		//Pagination Strat END //
}
?>


