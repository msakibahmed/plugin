<?php

    function reviews_data_list() {
        global $wpdb;
        $table_name ="reviews";

        $pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;      

        $limit = 5; // number of rows in page
        $offset = ( $pagenum - 1 ) * $limit;
        $total = $wpdb->get_var( "select count(*) as total from $table_name" );
        $num_of_pages = ceil( $total / $limit );

        //$rows = $wpdb->get_results( "SELECT id,hotel_id,rating from $table_name limit  $offset, $limit" );

		$rows = $wpdb->get_results( "SELECT * FROM hotels INNER JOIN reviews ON hotels.id = reviews.hotel_id" );
		//var_dump($rows);
		
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
				<th>Hotel Id</th><th>Ratings</th>
			</tr>
			<tbody>
			<?php
				if($rowcount>0)
				{
					foreach ($rows as $row) 
					{ 
						?>
						<tr>
							<td class="manage-column ss-list-width"><?php echo $row->hotel; ?></td>
							<td class="manage-column ss-list-width"><?php echo $row->rating; ?></td>
							
							
							
							<td class="respns"><a href="<?php echo admin_url('admin.php?page=reviews_data_update&id=' . $row->id); ?>"><button type="button" class="btn btn-primary">Update</button></a></a></td>
							<td class="respns"> <a href="<?php echo admin_url('admin.php?page=reviews_data_delete&id=' . $row->id); ?>"><button type="button" class="btn btn-danger">Delete</button></a></td>
						</tr>
						<?php 
					} 
				}
				else{
						echo "<tr><td cols=an='5'>No records found</td></tr>";
					} ?>
		</table>

			
		<div class="alignleft actions addbutton">
			<a href="<?php echo admin_url('admin.php?page=reviews_data_create'); ?>"><button type="button" class="btn btn-success">Add New</button></a></a>
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