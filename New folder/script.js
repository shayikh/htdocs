const search = document.getElementById('search');
const result = document.getElementById('result');

search.addEventListener('keyup', async function(e) {
  if (e.key !== 'Enter') return;
  const word = search.value.trim();
  if (!word) return;

  const res = await fetch('api.php?word=' + encodeURIComponent(word));
  const data = await res.json();

  if (data.error) {
    result.innerHTML = data.error;
    return;
  }

  result.innerHTML = `<h2>${data.word}</h2><p>${data.bangla}</p>`;
});