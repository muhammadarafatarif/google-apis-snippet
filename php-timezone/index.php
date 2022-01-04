<?php use imelgrat\GoogleMapsTimeZone\GoogleMapsTimeZone;
require_once ('src/GoogleMapsTimeZone.php');

/**
 * All queries require an API key from Google
 * @link https://developers.google.com/maps/documentation/timezone/get-api-key
 * */
define('API_KEY', 'YOUR_API_KEY');

// Initialize GoogleMapsTimeZone object (New York City coordinates)
$timezone_object = new GoogleMapsTimeZone(59.9139, 10.7522, 0, GoogleMapsTimeZone::FORMAT_JSON);

// Set Google API key
$timezone_object->setApiKey(API_KEY);

// Perform query 
$timezone_data = $timezone_object->queryTimeZone();

echo '<pre>';
print_r($timezone_data);
echo '</pre>';

$origin_tz = $timezone_data['timeZoneId']; // TIMEZONE VALUE YOU GET FROM THE RESPONSE OF MAPS API
$remote_tz = 'UTC'; // UTC TIMEZONE
$origin_dtz = new DateTimeZone($origin_tz);
$remote_dtz = new DateTimeZone($remote_tz);
$origin_dt = new DateTime("now", $origin_dtz);
$remote_dt = new DateTime("now", $remote_dtz);
$offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt); // TIME DIFFERENCE IN SECONDS
echo $offset/ (60*60); // TIME DIFFERENCE IN HOURS


?>