<?php
$con = mysql_connect("webdesigneguyi.db.8359509.hostedresource.com","webdesigneguyi","Admin@wd9");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  else
  {
	  $red_url = '';
	  if(isset($_REQUEST['red_url']))
	  $red_url = $_REQUEST['red_url'];
	  
	  $url = '';
	  if(isset($_REQUEST['url']))
	  $url = $_REQUEST['url'];
	  
	  
	   $address = '';
	  if(isset($_REQUEST['address']))
	  $address = $_REQUEST['address'];
	  
	 
	 mysql_select_db("webdesigneguyi", $con);

mysql_query("INSERT INTO client_loc (address, latitude, longitude,url,red_url)
VALUES ('".$address."', '".$_REQUEST['latitude']."','".$_REQUEST['longitude']."','".$url."','".$red_url."')");

mysql_close($con);
	 
	 
	  
	  }
	  
	 //echo 'latitude - '.$_REQUEST['latitude'];

?>