<?php

    function hotel_info_data_list() {
        global $wpdb;
        $table_name ="hotels";

        $pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;      

        $limit = 5; // number of rows in page
        $offset = ( $pagenum - 1 ) * $limit;
        $total = $wpdb->get_var( "select count(*) as total from $table_name" );
        $num_of_pages = ceil( $total / $limit );

        $rows = $wpdb->get_results( "SELECT * from $table_name limit  $offset, $limit" );
		//var_dump($rows);
        $rowcount = $wpdb->num_rows;

    ?>
       <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>mywp/sinetiks-schools/style-admin.css" rel="stylesheet" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div class="wrap abs insertdata">
        <h2>Hotel Information List</h2>
        <?php $path_array = wp_upload_dir()['baseurl']; // wp_upload_dir has diffrent types of array I am used 'baseurl' for path ?>
		<table id="miyazaki" class="table-striped table-hover col-sm-12">
			<thead>
			<tr>
				<th>ID</th><th>County Name</th><th>Hotel Name</th><th>Images</th><th>Kids Info</th><th>Adults Info</th><th>Description </th><th>Lat </th><th>Lang </th>
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
							<td class="manage-column ss-list-width"><?php echo $row->hotel; ?></td>
							<td><img src="data:image/jpeg;base64, <?php echo  $row->image_1;?> " height="100px" width="100px" />
							<img src="data:image/jpeg;base64, <?php echo  $row->image_2;?> " height="100px" width="100px" />
							<img src="data:image/jpeg;base64, <?php echo  $row->image_3;?> " height="100px" width="100px" />
							
							<?php if(!empty($row->image_4)){
								?>
								<img src="data:image/jpeg;base64, <?php echo  $row->image_4;?> " height="100px" width="100px" />
								<?php
							}else{}
							?>
							<?php if(!empty($row->image_4)){
								?>
							<img src="data:image/jpeg;base64, <?php echo  $row->image_5;?> " height="100px" width="100px" />
								<?php
							}else{}
							?>
							<?php if(!empty($row->image_4)){
								?>
								<img src="data:image/jpeg;base64, <?php echo  $row->image_6;?> " height="100px" width="100px" />
								<?php
							}else{}
							?>
							<?php if(!empty($row->image_4)){
								?>
								<img src="data:image/jpeg;base64, <?php echo  $row->image_7;?> " height="100px" width="100px" />
								<?php
							}else{}
							?>
							<?php if(!empty($row->image_4)){
								?>
								<img src="data:image/jpeg;base64, <?php echo  $row->image_8;?> " height="100px" width="100px" />
								<?php
							}else{}
							?>
							
							</td>
							
							
							
							<td class="manage-column ss-list-width"><?php echo substr($row->kids, 0 , 150);?>....</td>
							<td class="manage-column ss-list-width"><?php echo substr($row->adult, 0 , 150); ?>....</td>
							<td class="manage-column ss-list-width"><?php echo substr($row->description, 0 , 150); ?>....</td>
							<td class="manage-column ss-list-width"><?php echo $row->lat ; ?> </td>
							<td class="manage-column ss-list-width"><?php echo $row->lang ; ?> </td>
							<td class="respns"><a href="<?php echo admin_url('admin.php?page=hotel_info_data_update&id=' . $row->id); ?>"><button type="button" class="btn btn-primary">Update</button></a></a></td>
							<td class="respns"> <a href="<?php echo admin_url('admin.php?page=hotel_info_data_delete&id=' . $row->id); ?>"><button type="button" class="btn btn-danger">Delete</button></a></td>

						</tr>
						<?php 
					} 
				}
				else{
						echo "<tr><td cols=an='5'>No records found</td></tr>";
					} ?>
		</table>

			
		<div class="alignleft actions addbutton">
			<a href="<?php echo admin_url('admin.php?page=hotel_info_data_create'); ?>"><button type="button" class="btn btn-success">Add New</button></a></a>
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