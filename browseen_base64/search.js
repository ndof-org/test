var data = [];

function loadJson() {
    var request = new XMLHttpRequest();
    request.open('GET', 'data.json', true);
    request.onload = function () {
        if (request.status >= 200 && request.status < 400) {
            data = JSON.parse(request.responseText);
        }
    }
    request.send();
}

function browseen(query) {
    query = query || document.getElementById('query').value.toLowerCase();
    console.log("search", query);
    document.getElementById('query').value = query;
    var results = data.filter(function (item) {
        return item.url.toLowerCase().includes(query) || item.description.toLowerCase().includes(query) || item.tags.some(tag => tag.toLowerCase() === query);
    });
    const resultsContainer = document.getElementById('results');
    resultsContainer.innerHTML = results.map(function (item, i) {
        return `
                <div class="result">
                    <h2><a href="${item.url}">${item.url}</a></h2>
                    <p>${item.description}</p>
                    <div class="tags">${item.tags.map(tag => `<a href="#" onclick="event.preventDefault(); browseen('${tag}')">${tag}</a>`).join(', ')}</div>
                    <img id="resultImage${i}" src="${item.screenshot_base64}" alt="screenshot of ${item.url}">
                </div>`;
    }).join('');
    results.forEach((item, i) => {
        setTimeout(() => {
            document.getElementById(`resultImage${i}`).src = item.screenshot_url;
        }, 1700);
    });
}


window.onload = loadJson;