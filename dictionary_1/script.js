const search = document.getElementById("search");
const resultDiv = document.getElementById("result");
const suggestionBox = document.getElementById("suggestionBox");

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

    /* -------------------------
       Suggestions
    ------------------------- */
    suggestTimeout = setTimeout(() => {
        fetch("suggest.php?q=" + encodeURIComponent(word))
            .then(res => res.json())
            .then(data => {
                if (search.value.trim() !== word) return;

                if (!data.length) {
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
            });
    }, 120);

    /* -------------------------
       Auto search result
    ------------------------- */
    searchTimeout = setTimeout(() => {
        loadWord(word);
    }, 250);
});

/* =========================
   CLICK SUGGESTION
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
   LOAD WORD
========================= */
function loadWord(word) {
    fetch("track.php?word=" + encodeURIComponent(word));

    fetch("api.php?word=" + encodeURIComponent(word))
        .then(res => res.json())
        .then(data => {
            if (search.value.trim() !== word) return;

            if (data.error) {
                resultDiv.innerHTML = `<div class="card">❌ ${data.error}</div>`;
                return;
            }

            let html = `
                <div class="card">
                    <div class="word-row">
                        <div class="word">${data.word}</div>
                        <div class="source-badge">${data.source}</div>
                    </div>

                    <div class="bangla">🇧🇩 ${data.bangla}</div>
            `;

            data.meanings.forEach(m => {
                html += `
                    <div class="meaning">
                        <div class="part-of-speech">${m.partOfSpeech}</div>
                        <ul>
                `;

                m.definitions.forEach(d => {
                    html += `<li>${d.definition}</li>`;
                });

                html += `
                        </ul>
                    </div>
                `;
            });

            html += `</div>`;

            resultDiv.innerHTML = html;
        });
}

/* =========================
   CLICK OUTSIDE
========================= */
document.addEventListener("click", function (e) {
    if (!e.target.closest(".search-wrapper")) {
        suggestionBox.innerHTML = "";
    }
});