<?php

// Append an object to a JSONL file
function appendObjectToJSONL($filename, $object) {
    $file = fopen($filename, "a");
    fwrite($file, json_encode($object) . EOL);
    fclose($file);
}

// Search for a specific object in the JSONL file
function searchObjectInJSONL($filename, $searchKey, $searchValue) {
    $file = fopen($filename, "r");
    while ($line = fgets($file)) {
        $object = json_decode($line);
        if ($object->$searchKey == $searchValue) {
            fclose($file);
            return $object;
        }
    }
    fclose($file);
    return null; // Object
