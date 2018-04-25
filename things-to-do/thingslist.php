<?php

    function thingsdatalist() {
        global $wpdb;
        $table_name ="things_to_do";

        $pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;      

        $limit = 5; // number of rows in page
        $offset = ( $pagenum - 1 ) * $limit;
        $total = $wpdb->get_var( "select count(*) as total from $table_name" );
        $num_of_pages = ceil( $total / $limit );

        $rows = $wpdb->get_results( "SELECT id,things_1,things_2,things_3,things_4,things_5,county from $table_name limit  $offset, $limit" );
		//var_dump($rows);
        $rowcount = $wpdb->num_rows;

    ?>
       <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>mywp/sinetiks-schools/style-admin.css" rel="stylesheet" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div class="wrap abs insertdata">
        <h2>Things List</h2>
        <?php $path_array = wp_upload_dir()['baseurl']; // wp_upload_dir has diffrent types of array I am used 'baseurl' for path ?>
		<table id="miyazaki" class="table-striped table-hover col-sm-12">
			<thead>
			<tr>
				<th>ID</th><th>Thnigs 1</th><th>Things 2</th><th>Things 3</th><th>Things 4</th><th>Things 5</th><th>County</th>
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
							<td class="manage-column ss-list-width"><?php echo $row->things_1; ?></td>
							<td class="manage-column ss-list-width"><?php echo $row->things_2; ?></td>
							<td class="manage-column ss-list-width"><?php echo $row->things_3; ?></td>
							<td class="manage-column ss-list-width"><?php echo $row->things_4; ?></td>
							<td class="manage-column ss-list-width"><?php echo $row->things_5; ?></td>
							<td class="manage-column ss-list-width"><?php echo $row->county; ?></td>
							
							
							<td class="respns"><a href="<?php echo admin_url('admin.php?page=things_data_update&id=' . $row->id); ?>"><button type="button" class="btn btn-primary">Update</button></a></a></td>
							<td class="respns"> <a href="<?php echo admin_url('admin.php?page=things_data_delete&id=' . $row->id); ?>"><button type="button" class="btn btn-danger">Delete</button></a></td>
						</tr>
						<?php 
					} 
				}
				else{
						echo "<tr><td cols=an='5'>No records found</td></tr>";
					} ?>
		</table>

			
		<div class="alignleft actions addbutton">
			<a href="<?php echo admin_url('admin.php?page=things_data_create'); ?>"><button type="button" class="btn btn-success">Add New</button></a></a>
		</div>
		<br class="clear">
	</div>	
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