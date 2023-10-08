<?php

// Search for a word in the JSONL file without decoding
function searchWordInJSONL($filename, $searchWord) {
    $file = fopen($filename, "r");
    while ($line = fgets($file)) {
        if (strpos($line, $searchWord) !== false) {
            fclose($file);
            return $line;
        }
    }
    fclose($file);
    return null; // Word not found
}



// Search for a specific word in the JSONL file
$searchWord = "Vegas";
$result = searchWordInJSONL("data.ndof", $searchWord);
if ($result) {
    echo "Found: " . $result;
} else {
    echo "Word not found!";
}
