const search = document.getElementById("search");
const resultDiv = document.getElementById("result");

let suggestionBox = document.createElement("div");
suggestionBox.className = "suggestions";
search.parentNode.appendChild(suggestionBox);

let timeout = null;

search.addEventListener("keyup", function () {
    clearTimeout(timeout);

    let word = this.value.trim();

    if (!word) {
        resultDiv.innerHTML = "";
        suggestionBox.innerHTML = "";
        return;
    }

    // 🔍 Suggestions
    fetch("suggest.php?q=" + word)
        .then(res => res.json())
        .then(data => {
            let html = "";
            data.forEach(w => {
                html += `<div onclick="selectWord('${w}')">${w}</div>`;
            });
            suggestionBox.innerHTML = html;
        });

    // ⏱ Main search
    timeout = setTimeout(() => {
        fetch("api.php?word=" + word)
            .then(res => res.json())
            .then(data => {

                if (data.error) {
                    resultDiv.innerHTML = "<p>❌ " + data.error + "</p>";
                    return;
                }

                let html = `
                    <h2>${data.word}</h2>
                    <div class="bangla">🇧🇩 ${data.bangla}</div>
                    <p><b>Source:</b> ${data.source}</p>
                `;

                data.meanings.forEach(m => {
                    html += `<b>${m.partOfSpeech}</b><ul>`;
                    m.definitions.forEach(d => {
                        html += `<li>${d.definition}</li>`;
                    });
                    html += `</ul>`;
                });

                resultDiv.innerHTML = html;
            });
    }, 400);
});

function selectWord(word) {
    search.value = word;
    suggestionBox.innerHTML = "";
}