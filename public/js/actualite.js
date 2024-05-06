// get news data

let elementForData=document.querySelector('#actualite_content');
const news=JSON.parse(elementForData.dataset.newsData)

console.log(news);

const actuality = () => {
    const articlesPerPage = 12;
    const totalPages = Math.ceil(news.length / articlesPerPage);

    function displayArticles(pageNumber, articlesToDisplay = news) {
        const start = (pageNumber - 1) * articlesPerPage;
        const end = start + articlesPerPage;
        const articles = articlesToDisplay.slice(start, end);

        const newsContainer = document.querySelector('#news-container');
        newsContainer.innerHTML = '';

        articles.forEach(article => {
            const articleElement = document.createElement('a');
            articleElement.href = `actuality_detail.php?id=${article.id}`;
            articleElement.className = 'single_new';

            const imgContainer = document.createElement('div');
            imgContainer.className = 'single_new_img';
            const img = document.createElement('img');
            img.src = article.img;
            imgContainer.appendChild(img);
            articleElement.appendChild(imgContainer);

            textContainer.className = 'single_new_text';
            textContainer.textContent = article.titre
            articleElement.appendChild(textContainer);

            const dateContainer = document.createElement('div');
            dateContainer.className = 'single_new_date';
            const icon = document.createElement('i');
            icon.className = 'icon icon-calendar';
            dateContainer.appendChild(icon);
            const dateText = document.createElement('p');
            dateText.className = 'single_new_date_p';
            dateText.textContent = article.date_publication;
            dateContainer.appendChild(dateText);
            articleElement.appendChild(dateContainer);

            newsContainer.appendChild(articleElement);
        });
    }

    function handlePagination(pageNumber, articlesToDisplay = news) {
        displayArticles(pageNumber, articlesToDisplay);
        updatePaginationButtons(pageNumber, articlesToDisplay);
    }

    function updatePaginationButtons(currentPage, articlesToDisplay = news) {
        const totalFilteredPages = Math.ceil(articlesToDisplay.length / articlesPerPage);

        const paginationContainer = document.querySelector('#pagination-container');
        paginationContainer.innerHTML = '';

        const prevButton = document.createElement('button');
        prevButton.className = 'arrow-btn';
        prevButton.disabled = currentPage === 1;
        prevButton.innerHTML = '<i class="icon icon-left arrow-btn"></i>';
        prevButton.onclick = () => handlePagination(currentPage - 1, articlesToDisplay);
        paginationContainer.appendChild(prevButton);

        for (let i = 1; i <= totalFilteredPages; i++) {
            const pageButton = document.createElement('span');
            pageButton.textContent = i;
            pageButton.className = i === currentPage ? 'active' : 'paginate-select';
            pageButton.onclick = () => handlePagination(i, articlesToDisplay);
            paginationContainer.appendChild(pageButton);
        }

        const nextButton = document.createElement('button');
        nextButton.className = 'arrow-btn';
        nextButton.disabled = currentPage === totalFilteredPages;
        nextButton.innerHTML = '<i class="icon icon-right arrow-btn"></i>';
        nextButton.onclick = () => handlePagination(currentPage + 1, articlesToDisplay);
        paginationContainer.appendChild(nextButton);
    }

    document.getElementById('search-input').addEventListener('input', (event) => {
        const searchQuery = event.target.value.toLowerCase();
        const filteredNews = news.filter(article => article.contenu.toLowerCase().includes(searchQuery));
        handlePagination(1, filteredNews);
    });
    handlePagination(1)

}
/**
 * Détails
 */

const actuality_detail = () => {
    function displayDetail() {
        const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('id');

        const article = news.find(item => item.id === parseInt(id));

        const title = document.querySelector('#article-title')
        const date = document.querySelector('#article-date')
        const content = document.querySelector('#article-content')
        const img = document.querySelector('#article-img')

        title.textContent = article.titre;
        date.textContent = article.date_publication;
        content.innerHTML = article.video? article.video + '<br>'+ article.contenu : article.contenu;
        img.src = article.img

        similarArticle()
    }

    function similarArticle() {
        // Récupérer le nombre total d'éléments dans le JSON news
        const totalElements = news.length;

        // Générer trois index aléatoires différents
        const randomIndexes = [];
        let counter = 0;
        while (randomIndexes.length < 3 && counter < 3) {
            const randomIndex = Math.floor(Math.random() * totalElements);
            if (!randomIndexes.includes(randomIndex)) {
                randomIndexes.push(randomIndex);
            }
            counter++;
        }
        const similarArticleElement = document.getElementById('similar-article');

        // Boucler sur les trois éléments aléatoires
        randomIndexes.forEach(index => {
            const article = news[index];
            const articleHTML = `
                <a href="actuality_detail.php?id=${article.id}" class="single_new">
                    <div class="single_new_img">
                    <img src="${article.img}" />
                    </div>
                    <p class="single_new_text">
                    ${article.titre}
                    </p>
                    <div class="single_new_date">
                    <i class="icon icon-calendar"></i>
                    <p class="single_new_date_p">${article.date_publication}</p>
                    </div>
                </a>
                `;
            similarArticleElement.innerHTML += articleHTML;

        });
    }

    displayDetail()
}

document.addEventListener('DOMContentLoaded', function (e) {
    const currentUrl = window.location.href;
    console.log(currentUrl)
    if (currentUrl.includes('actualite.php')) {
        actuality()
    }
    else if (currentUrl.includes('actuality_detail.php')) {
        actuality_detail()
    }
})