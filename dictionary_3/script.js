const search = document.getElementById("search");
const resultDiv = document.getElementById("result");
const suggestionBox = document.getElementById("suggestions");

let timeout = null;

/* input typing */
search.addEventListener("input", function () {
    clearTimeout(timeout);

    const word = this.value.trim();

    if (!word) {
        resultDiv.innerHTML = "";
        suggestionBox.innerHTML = "";
        return;
    }

    loadSuggestions(word);

    timeout = setTimeout(() => {
        searchWord(word);
    }, 400);
});

/* fetch suggestions */
function loadSuggestions(word) {
    fetch("suggest.php?q=" + encodeURIComponent(word))
        .then(res => res.json())
        .then(data => {
            suggestionBox.innerHTML = "";

            if (!Array.isArray(data) || !data.length) return;

            data.forEach(w => {
                const item = document.createElement("div");
                item.textContent = w;

                item.addEventListener("mousedown", function (e) {
                    e.preventDefault();
                    selectWord(w);
                });

                suggestionBox.appendChild(item);
            });
        })
        .catch(() => {
            suggestionBox.innerHTML = "";
        });
}

/* fetch meaning */
function searchWord(word) {
    fetch("api.php?word=" + encodeURIComponent(word))
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                resultDiv.innerHTML = `<p>❌ ${data.error}</p>`;
                return;
            }

            let html = `
                <div class="result-top">
                    <span class="source-badge">${data.source}</span>
                </div>

                <h2>${data.word}</h2>
                <div class="bangla">🇧🇩 ${data.bangla}</div>
            `;

            if (Array.isArray(data.meanings)) {
                data.meanings.forEach(m => {
                    html += `
                        <div class="meaning-block">
                            <h4>${m.partOfSpeech}</h4>
                            <ul>
                    `;

                    if (Array.isArray(m.definitions)) {
                        m.definitions.forEach(d => {
                            html += `<li>${d.definition}</li>`;
                        });
                    }

                    html += `
                            </ul>
                        </div>
                    `;
                });
            }

            resultDiv.innerHTML = html;
        })
        .catch(() => {
            resultDiv.innerHTML = `<p>❌ Failed to load data.</p>`;
        });
}

/* select suggestion */
function selectWord(word) {
    search.value = word;
    suggestionBox.innerHTML = "";
    searchWord(word);
}

/* hide suggestions when clicking outside */
document.addEventListener("click", function (e) {
    if (!document.querySelector(".search-box").contains(e.target)) {
        suggestionBox.innerHTML = "";
    }
});