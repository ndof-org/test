<?php

// Append an object to a JSONL file
function appendObject($filename, $object) {
    $file = fopen($filename, "a");
    fwrite($file, json_encode($object) . EOL);
    fclose($file);
}


// Example objects
$person1 = (object) array("name" => "John Doe", "age" => 30, "occupation" => "Engineer");
$person2 = (object) array("name" => "Jane Smith", "age" => 25, "occupation" => "Designer");

// Append objects to the file
appendObject("data.ndof", $person1);
appendObject("data.ndof", $person2);
