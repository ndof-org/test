var data = [];

function loadJson() {
    var request = new XMLHttpRequest();
    request.open('GET', 'data.json', true);
    request.onload = function() {
        if (request.status >= 200 && request.status < 400) {
            data = JSON.parse(request.responseText);
        }
    }
    request.send();
}

function search() {
    var query = document.getElementById('query').value.toLowerCase();
    var results = data.filter(function(item) {
        return item.url.toLowerCase().includes(query) || item.description.toLowerCase().includes(query) || item.tags.some(tag => tag.toLowerCase().includes(query));
    });
    document.getElementById('results').innerHTML = results.map(function(item) {
        return `
                <div class="result">
                    <h2><a href="${item.url}">${item.url}</a></h2>
                    <p>${item.description}</p>
                    <div class="tags">${item.tags.join(', ')}</div>
                    <img src="${item.screenshot}" alt="screenshot of ${item.url}">
                </div>`;
    }).join('');
}

window.onload = loadJson;