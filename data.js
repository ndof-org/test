// With Node.js, you first create a readable stream from the file using `fs.createReadStream()`. 
// Then, you create an interface for reading from the stream line by line. 
// For each line, you parse the JSON and log the object to the console. 
const fs = require('fs');
const readline = require('readline');

let readStream = fs.createReadStream('file.ndjson');

let lineReader = readline.createInterface({
  input: readStream
});

lineReader.on('line', function (line) {
  let obj = JSON.parse(line);
  console.log(obj);
});

lineReader.on('close', function () {
  console.log('Finished reading the file');
});
