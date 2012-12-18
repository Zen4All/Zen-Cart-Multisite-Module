<?php
	$default_server_name = $_SERVER['HTTP_HOST'];
	$config_file = $default_server_name.'_config.php';
 // echo $config_file;
//  exit;
	if(file_exists("includes/config_sites/".$config_file)) {
		include("includes/config_sites/".$config_file);
	} else {
		echo "the domain ".$default_server_name." does not exist.";
		exit;
	}

	//Name of the site that is written in the categories
	define('SITE_NAME',$default_server_name); // JCK changed from $config_file 7/23/09
	//The order for this site will be seen for ORDER_SITE from the admin section
	define('ORDER_SITE',SITE_NAME);
  	define('HTTP_SERVER', "http://".$default_server_name);
  	define('HTTPS_SERVER', "https://".$default_server_name);
  	
  	//Define the parent category as 0 if not defined
	define('CATEGORIES_ROOT','0');
?>
