<?php

function writeObjectsToFile($filename, $objects)
{
    $file = fopen($filename, 'a');
    if ($file === false) {
        die("Unable to open the file.");
    }

    foreach ($objects as $object) {
        fwrite($file, json_encode($object) . PHP_EOL);
    }

    fclose($file);
}

function readObjectsFromFile($filename)
{
    $file = fopen($filename, 'r');
    if ($file === false) {
        die("Unable to open the file.");
    }

    $objects = [];

    while (($line = fgets($file)) !== false) {
        $objects[] = $line;
    }

    fclose($file);

    return $objects;
}

function searchAndReplaceObject($filename, $searchWord, $newObject)
{
    $lines = file($filename);
    $newObjectJson = json_encode($newObject);

    foreach ($lines as $key => $line) {
        if (strpos($line, $searchWord) !== false) {            
            $lines[$key] = $newObjectJson . PHP_EOL;
        }
    }

    file_put_contents($filename, $lines);
}


$objects = [
    ['name' => 'John', 'age' => 25],
    ['name' => 'Sara', 'age' => 23],
];

$filename = 'data.dnof';

writeObjectsToFile($filename, $objects);

print_r(readObjectsFromFile($filename));

$searchWord = 'John';
$newObject = ['name' => 'John', 'age' => 26];

searchAndReplaceObject($filename, $searchWord, $newObject);

print_r(readObjectsFromFile($filename));


?>      
