const search = document.getElementById("search");
const resultDiv = document.getElementById("result");

let timeout = null;

search.addEventListener("keyup", function () {
    clearTimeout(timeout);

    let word = this.value.trim();

    if (!word) {
        resultDiv.innerHTML = "";
        return;
    }

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
                    html += `<div class="meaning">
                        <b>${m.partOfSpeech}</b><ul>`;

                    m.definitions.forEach(d => {
                        html += `<li>${d.definition}`;
                        if (d.example) {
                            html += `<br><i>Example: ${d.example}</i>`;
                        }
                        html += `</li>`;
                    });

                    html += `</ul></div>`;
                });

                resultDiv.innerHTML = html;

            });
    }, 500);
});