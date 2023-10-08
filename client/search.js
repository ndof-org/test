var data = [];

function loadJson() {
    var request = new XMLHttpRequest();
    request.open('GET', 'data.json', true);
    request.onload = function() {
        if (request.status >= 200 && request.status < 400) {
            data = JSON.parse(request.responseText);
            console.log(data);
        }
    }
    request.send();
}

function search() {
    var query = document.getElementById('query').value.toLowerCase();
    var results = data.filter(function(item) {
        return item.toLowerCase().includes(query);
    });
    document.getElementById('results').innerHTML = results.join('<br>');
}

window.onload = loadJson;