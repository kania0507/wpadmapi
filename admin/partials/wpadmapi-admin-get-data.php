<?php

/**
 * Provide data from api to admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://seowp.pl
 * @since      1.0.0
 *
 * @package    Wpadmapi
 * @subpackage Wpadmapi/admin/partials
 */
?>


<?php  
$cluesArray = array();
//$json = file_get_contents(MY_PLUGIN_PATH.'/clues.json');

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://jservice.io/api/clues",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);



$cluesArray = json_decode($response, true);