document.addEventListener("DOMContentLoaded", function() {
    // Load live auctions
    fetchLiveAuctions();
    // Load latest news
    fetchNews();
});

function fetchLiveAuctions() {
    // Fetch live auction data from API
    fetch('/api/live-auctions')
        .then(response => response.json())
        .then(data => {
            const auctionList = document.getElementById('auction-list');
            data.forEach(auction => {
                const auctionItem = document.createElement('div');
                auctionItem.className = 'auction-item';
                auctionItem.innerHTML = `
                    <h3>${auction.title}</h3>
                    <p>Current Bid: $${auction.currentBid}</p>
                    <button onclick="placeBid(${auction.id})">Bid</button>
                `;
                auctionList.appendChild(auctionItem);
            });
        });
}

function fetchNews() {
    // Fetch latest news from API
    fetch('/api/news')
        .then(response => response.json())
        .then(data => {
            const newsList = document.getElementById('news-list');
            data.forEach(news => {
                const newsItem = document.createElement('div');
                newsItem.className = 'news-item';
                newsItem.innerHTML = `
                    <h3>${news.title}</h3>
                    <p>${news.summary}</p>
                    <a href="${news.link}">Read more</a>
                `;
                newsList.appendChild(newsItem);
            });
        });
}

function placeBid(auctionId) {
    // Handle bidding logic here
    alert(`Placing bid on auction ID: ${auctionId}`);
}
