<?php
$bearerToken = '91e72f6956518f0337d9eaf07add3f1ec1737a2bdf0c64ff782bf50558375947';

function getApiMovies(){
    global $bearerToken;

    // Initialize cURL session
    $ch = curl_init();

    // API endpoint URL
    $url = 'https://annexbios.nickvz.nl/api/v1/movieData';

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $bearerToken,
        'Content-Type: application/json'
    ]);

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        // Process the response
        $data = json_decode($response, true);
        return $data;
    }

    // Close cURL session
    curl_close($ch);
}

function getApiMovie($id){
    global $bearerToken;

    // Initialize cURL session
    $ch = curl_init();

    // API endpoint URL
    $url = 'https://annexbios.nickvz.nl/api/v1/movieData/' . $id;

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $bearerToken,
        'Content-Type: application/json'
    ]);

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        // Process the response
        $data = json_decode($response, true);
        return $data;
    }

    // Close cURL session
    curl_close($ch);
}


function getApiMoviePlaying($id) {
    global $bearerToken;

    // Initialize cURL session
    $ch = curl_init();

    // API endpoint URL
    $url = 'https://annexbios.nickvz.nl/api/v1/playingMovies/' . $id;

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $bearerToken,
        'Content-Type: application/json'
    ]);

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        // Process the response
        $data = json_decode($response, true);
        return $data;
    }

    // Close cURL session
    curl_close($ch);
}


?>