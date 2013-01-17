<?PHP

				include('../../../wp-blog-header.php');

				

				

				function del_georecord($id){

					global $wpdb;

				$table_name = $wpdb->prefix . "geo_redirector";

					$delete_query = "DELETE from ".$table_name." where id = '".$id."' ;";

					$results = $wpdb->query( $delete_query );

echo $delete_query;

					

					}

				

				

				if(isset($_REQUEST['action'])){

					

					switch ($_REQUEST['action']){

						case 'del':{

								del_georecord($_REQUEST['id']);

							}break;

						default: echo ""; break;

						}

						

					

					}

				

				

?>