<?php

/*

Plugin Name: GEO Redirector

Plugin URI: http://anushkar.com

Description: Redirect pages according to the geo location

Author: Anushka Rajasingha

Author URI: http://anushkar.com

Version: 1.0.1

*/







register_activation_hook( __FILE__, 'geo_redirector_install' );

register_deactivation_hook(__FILE__,'geo_redirector_uninstall');

add_action('wp_head', 'custom_header_function');

if (is_admin()) {

	include "installer.php";

}



function custom_header_function(){

//if (!is_admin()) {

$to = 'http://www.google.com';

//header("Location: " . $to);

	//	exit;

echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>';

echo  '<script type="text/javascript" src="http://www.google.com/jsapi"></script>';

echo  '<script src="http://maps.google.com/maps/api/js?sensor=false&v=3&libraries=geometry" type="text/javascript"></script> ';

echo '<script src="'.plugins_url('/js/clientredirect.php', __FILE__).'" type="text/javascript" > </script>';

//}



}



// create custom plugin settings menu

add_action('admin_menu', 'geo_redirect_menu');



function geo_redirect_menu() {



	//create new top-level menu

	add_menu_page('GEO Redirector Plugin Settings', 'GEO Redirector', 'administrator', __FILE__, 'geo_redirect_settings_page',plugins_url('/images/f_redirect.png', __FILE__));



	//call register settings function

	

}









function geo_redirect_settings_page() {

?>

<div class="wrap">

<h2>GEO Redirector</h2>

<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script> 

<script src="<?php echo plugins_url('/js/form_action.php', __FILE__); ?>" type="text/javascript" > </script>

<script type="text/javascript" >



</script>

<div id="message">



</div>

<form method="post" onsubmit="geo_redirect_onsubmit(this);return false;" id="geo_submitform" >

 

     <table class="form-table">

     

        

        <tr valign="top">

        <th scope="row">Street Address Or ZIP Code</th>

        <td width="400px"><input type="text" name="address"  class="regular-text required" title="Address / Physical Location Name"/> <br/><small>After you enter the address or ZIP code please verify the location before it save.</small></td>

        <td width="100px;"> <input type="button" class="button-primary" value="<?php _e('Location Verify') ?>" onclick="get_langlongfromaddress(jQuery('input[name=address]').val());" />  </td>

        <td rowspan="4"><div id="map_canvas" style="display:block;width:100%;height:200px;"></div></td>

        </tr>

         <tr valign="top">

        <th scope="row">Formatted address</th>

        <td><input type="text" disabled="disabled" name="formatted_address" class="regular-text"  id="formatted_address"  /> </td>

        <td ></td>

        </tr>

        <tr valign="top">

        <th scope="row">Latitude</th>

        <td><input type="text" name="latitude" title="Latitude" class="required" /></td>

        <td ></td>

        </tr>

        

        <tr valign="top">

        <th scope="row">Longitude</th>

        <td><input type="text" name="longitude" title="Longitude"  class="required" /></td>

                <td ></td>

        </tr>

        

        <tr valign="top">

        <th scope="row">Radius</th>

        <td><input type="text" name="radius" title="Radius"  class="required" />&nbsp;km</td>

                <td ></td>

        </tr>

         <tr valign="top">

        <th scope="row">URL</th>

        <td><input type="text" name="cur_url" class="regular-text" title="Redirect URL"  /><br/><small>if you leave this field empty, the default value would be <?php echo get_site_url(); ?></small></td>

                <td ></td>

        </tr>

        <tr valign="top">

        <th scope="row">Redirect URL</th>

        <td><input type="text" name="red_url" class="regular-text required" title="Redirect URL"  /><br/><small>Please enter full URL (Ex: http://www.abcdef.com).</small></td>

                <td ></td>

        </tr>

         <tr valign="top">

        <th scope="row">Not in Radius</th>

        <td><input type="checkbox" name="isnot" title="Not In" /></td>

        <td ></td>

        </tr>

       

    </table>

     <input type="hidden" value="" name="hid_id" id="hid_id" />

    <p class="submit">

    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />

    <input type="button" id="btn_cancel" class="button-primary" value="<?php _e('Cancel') ?>" style="display:none;" onclick="reset_from();" />

    </p>



</form>

<div id="geo_datadisplay">

<?php include('display.php'); ?>

</div>

</div>

<?php } ?>