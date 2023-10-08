<?php
    header('Content-Type: application/json');

    // Load the data from the JSON file
    $data = json_decode(file_get_contents('data.json'), true);

    // Fetch the query
    $query = $_POST['query'];

    // Define results array
    $results = array();

    // Loop through the data to search for the query
    foreach($data as $item) {
        // Check if the query is in any item of data
        if (strpos($item, $query) !== false) {
            // If found, add to results
            $results[] = $item;
        }
    }

    // Print out the results as a JSON object
    echo json_encode(array("results" => $results));
?>