<?php

// Replace a specific object in the JSONL file
function replaceObject($filename, $searchKey, $searchValue, $replacementObject) {
    // Read the file
    $file = file($filename);

    // Iterate through each line and find the target object
    foreach ($file as $index => $line) {
        $object = json_decode($line);
        
        // Check if the target object is found
        if ($object->$searchKey == $searchValue) {
            // Replace the object with the replacement object
            $file[$index] = json_encode($replacementObject) . "\n";
            break;
        }
    }

    // Write the modified objects back into the file
    file_put_contents($filename, implode("", $file));
}

// USAGE:

// Replace a specific object in the JSONL file
$searchKey = "name";
$searchValue = "John Doe";
$replacementObject = (object) array("name" => "John Smith", "age" => 35, "occupation" => "Manager");
replaceObjectInJSONL("data.ndof", $searchKey, $searchValue, $replacementObject);
