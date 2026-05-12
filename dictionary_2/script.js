const search = document.getElementById("search");
const resultDiv = document.getElementById("result");
const suggestionBox = document.getElementById("suggestions");

let searchTimeout = null;
let suggestTimeout = null;

/* =========================
   INPUT EVENT
========================= */
search.addEventListener("input", function () {
    const word = this.value.trim();

    clearTimeout(searchTimeout);
    clearTimeout(suggestTimeout);

    if (!word) {
        suggestionBox.innerHTML = "";
        resultDiv.innerHTML = "";
        return;
    }

    /* =========================
       AUTO SUGGESTIONS
    ========================= */
    suggestTimeout = setTimeout(() => {
        fetch("suggest.php?q=" + encodeURIComponent(word))
            .then(res => res.json())
            .then(data => {

                if (!data.length || search.value.trim() !== word) {
                    suggestionBox.innerHTML = "";
                    return;
                }

                let html = "";

                data.forEach(w => {
                    html += `
                        <div class="suggestion-item" data-word="${w}">
                            ${w}
                        </div>
                    `;
                });

                suggestionBox.innerHTML = html;
            })
            .catch(() => {
                suggestionBox.innerHTML = "";
            });
    }, 120);

    /* =========================
       AUTO SEARCH RESULT
    ========================= */
    searchTimeout = setTimeout(() => {
        loadWord(word);
    }, 250);
});

/* =========================
   CLICK SUGGESTION (FIXED)
========================= */
suggestionBox.addEventListener("mousedown", function (e) {
    const item = e.target.closest(".suggestion-item");
    if (!item) return;

    e.preventDefault();

    const word = item.dataset.word;

    search.value = word;

    suggestionBox.innerHTML = "";

    clearTimeout(searchTimeout);
    clearTimeout(suggestTimeout);

    loadWord(word);
});

/* =========================
   LOAD WORD FROM API
========================= */
function loadWord(word) {

    fetch("api.php?word=" + encodeURIComponent(word))
        .then(res => res.json())
        .then(data => {

            if (search.value.trim() !== word) return;

            if (data.error) {
                resultDiv.innerHTML = `<div class="result-card">❌ ${data.error}</div>`;
                return;
            }

            /* =========================
               PREMIUM RESULT UI
            ========================= */
            let html = `
                <div class="result-card">

                    <div class="result-top">
                        <div class="source-badge">${data.source}</div>
                    </div>

                    <h2>${data.word}</h2>
                    <span class="bangla">🇧🇩 ${data.bangla}</span>

                    <div class="result-divider"></div>
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

            html += `</div>`;

            resultDiv.innerHTML = html;
        })
        .catch(() => {
            resultDiv.innerHTML = `<div class="result-card">❌ Failed to load data</div>`;
        });
}

/* =========================
   CLICK OUTSIDE CLOSE
========================= */
document.addEventListener("click", function (e) {
    if (!e.target.closest(".search-box")) {
        suggestionBox.innerHTML = "";
    }
});