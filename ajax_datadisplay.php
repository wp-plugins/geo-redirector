<table cellspacing="0" class="wp-list-table widefat" id="geo_tatatable">
	<thead>
	<tr>
		<th >Id</th>
        		<th >Address / Location</th>
                		<th >Latitude</th>
                        		<th >Longitude</th>
                                		<th >Radius</th>
                                        <th >URL</th>
                                        <th >Redirect URL</th>
                                        <th >Not in Radius</th>                                        
                                        <th>&nbsp;</th>
                                        		
	</thead>

	

	<tbody>
				<?PHP
				include('../../../wp-blog-header.php');
				global $wpdb;
				$table_name = $wpdb->prefix . "geo_redirector";
				$result_current = $wpdb->get_results( "SELECT * FROM ".$table_name.""); 
				
foreach($result_current as $row)
 {
echo "<tr id='tr_".$row->id."' >";
 echo '<td>'.$row->id."</td><td>".$row->address."</td><td>".$row->latitude."</td><td>".$row->longitude."</td><td>".$row->radius."</td><td>".$row->cur_url."</td><td>".$row->red_url."</td><td>".$row->isnot."</td><td><input type='button' class='button-primary' value='Delete'  onclick='delete_georecord(".$row->id.");'/>  <input type='button' class='button-primary' value='Edit' onclick='edit_georecord(".$row->id.");' /></td> ";
echo '</tr>';
 }

?>
                
		</tbody>
</table>

