const search = document.getElementById("search");
const resultDiv = document.getElementById("result");
const suggestionBox = document.getElementById("suggestions");

let dictionary = {};
let words = [];
let prefixIndex = {};

let searchTimeout = null;
let suggestTimeout = null;
let isReady = false;

/* =========================
   INITIAL UI
========================= */
resultDiv.innerHTML = `<p>Loading dictionary…</p>`;

/* =========================
   BACKGROUND LOAD
========================= */
(async function init() {
    const res = await fetch("./dictionary.json");
    const data = await res.json();

    dictionary = data || {};
    words = Object.keys(dictionary).sort();

    buildPrefixIndex();

    isReady = true;
    resultDiv.innerHTML = "";
})();

/* =========================
   BUILD PREFIX INDEX
========================= */
function buildPrefixIndex() {
    prefixIndex = {};

    for (let i = 0; i < words.length; i++) {
        const word = words[i];

        if (word.length >= 1) {
            const p1 = word.slice(0, 1);
            if (prefixIndex[p1] === undefined) prefixIndex[p1] = i;
        }

        if (word.length >= 2) {
            const p2 = word.slice(0, 2);
            if (prefixIndex[p2] === undefined) prefixIndex[p2] = i;
        }

        if (word.length >= 3) {
            const p3 = word.slice(0, 3);
            if (prefixIndex[p3] === undefined) prefixIndex[p3] = i;
        }
    }
}

/* =========================
   INPUT EVENT
========================= */
search.addEventListener("input", function () {
    if (!isReady) return;

    const word = this.value.trim().toLowerCase();

    clearTimeout(searchTimeout);
    clearTimeout(suggestTimeout);

    if (!word) {
        suggestionBox.innerHTML = "";
        resultDiv.innerHTML = "";
        return;
    }

    suggestTimeout = setTimeout(() => {
        renderSuggestions(word);
    }, 20);

    searchTimeout = setTimeout(() => {
        loadWord(word);
    }, 60);
});

/* =========================
   LOWER BOUND
========================= */
function lowerBound(arr, prefix, start = 0) {
    let left = start;
    let right = arr.length;

    while (left < right) {
        const mid = (left + right) >> 1;

        if (arr[mid] < prefix) {
            left = mid + 1;
        } else {
            right = mid;
        }
    }

    return left;
}

/* =========================
   PREFIX START
========================= */
function getPrefixStart(prefix) {
    if (prefix.length >= 3 && prefixIndex[prefix.slice(0, 3)] !== undefined) {
        return prefixIndex[prefix.slice(0, 3)];
    }

    if (prefix.length >= 2 && prefixIndex[prefix.slice(0, 2)] !== undefined) {
        return prefixIndex[prefix.slice(0, 2)];
    }

    if (prefix.length >= 1 && prefixIndex[prefix.slice(0, 1)] !== undefined) {
        return prefixIndex[prefix.slice(0, 1)];
    }

    return 0;
}

/* =========================
   RENDER SUGGESTIONS
========================= */
function renderSuggestions(prefix) {
    let html = "";
    let count = 0;

    const startHint = getPrefixStart(prefix);
    const start = lowerBound(words, prefix, startHint);

    for (let i = start; i < words.length; i++) {
        const w = words[i];

        if (!w.startsWith(prefix)) break;

        html += `<div class="suggestion-item" data-word="${w}">${w}</div>`;
        count++;

        if (count >= 10) break;
    }

    suggestionBox.innerHTML = html;
}

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
    const data = dictionary[word];

    if (!data) {
        resultDiv.innerHTML = `<p>❌ Word not found</p>`;
        return;
    }

    let html = `
        <div class="result-top">
            <div class="source-badge">json</div>
        </div>

        <h2>${data.word || word}</h2>
        <span class="bangla">🇧🇩 ${data.bangla || ""}</span>
    `;

    if (Array.isArray(data.meanings)) {
        data.meanings.forEach(m => {
            html += `
                <div class="meaning-block">
                    <h4>${m.partOfSpeech || ""}</h4>
                    <ul>
            `;

            if (Array.isArray(m.definitions)) {
                m.definitions.forEach(d => {
                    html += `<li>${d.definition || ""}</li>`;
                });
            }

            html += `
                    </ul>
                </div>
            `;
        });
    }

    resultDiv.innerHTML = html;
}

/* =========================
   CLICK OUTSIDE
========================= */
document.addEventListener("click", function (e) {
    if (!e.target.closest(".search-box")) {
        suggestionBox.innerHTML = "";
    }
});