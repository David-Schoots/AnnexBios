<?php

/* $api_url = 'https://annexbios-server.onrender.com/api';

// Read JSON file
$json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
$response_data = json_decode($json_data);

// All movie data exists in 'movie' object
$movie_data = $response_data->$movie;

$movie_data = array_slice($movie_data,0, 9);

print_r($movie_data);
 */

// Initializing curl
$curl = curl_init();
  
// Sending GET request to reqres.in
// server to get JSON data
curl_setopt($curl, CURLOPT_URL, 
    "https://annexbios-server.onrender.com/api");
  
// Telling curl to store JSON
// data in a variable instead
// of dumping on screen
curl_setopt($curl, 
    CURLOPT_RETURNTRANSFER, true);
  
// Executing curl
$response = curl_exec($curl);

// Checking if any error occurs 
// during request or not
if($e = curl_error($curl)) {
    echo $e;
} else {
    
    // Decoding JSON data
    $decodedData = 
        json_decode($response, true); 
        
    // Outputting JSON data in
    // Decoded form
    var_dump($decodedData);
}

// Closing curl
curl_close($curl);

?>