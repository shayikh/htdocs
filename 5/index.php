<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Modern Feed</title>

<style>
* { box-sizing: border-box; }

body {
    margin: 0;
    background: radial-gradient(circle at top, #e9f1ff, #f6f8fc);
    font-family: system-ui, -apple-system, Segoe UI, sans-serif;
}

/* WRAPPER */
.wrapper {
    width: 480px;
    margin: 40px auto;
}

/* CARD */
.card {
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(12px);
    border-radius: 18px;
    padding: 18px;
    box-shadow: 0 18px 40px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}

/* TITLE */
.title {
    font-weight: 600;
    margin-bottom: 10px;
    color: #222;
}

/* SHARED WIDTH */
textarea, .dropzone, button {
    width: 100%;
}

/* TEXTAREA */
textarea {
    height: 90px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    padding: 12px;
    resize: none;
    outline: none;
    transition: 0.25s;
}

textarea:hover {
    border-color: #7aa7ff;
}

textarea:focus {
    border-color: #4f8cff;
    box-shadow: 0 0 0 4px rgba(79,140,255,0.15);
}

/* DROPZONE */
.dropzone {
    margin-top: 12px;
    padding: 28px;
    border-radius: 14px;
    border: 2px dashed #cfd8e3;
    text-align: center;
    cursor: pointer;
    color: #6b7280;
    transition: 0.25s;
}

.dropzone:hover {
    border-color: #4f8cff;
    color: #4f8cff;
    background: rgba(79,140,255,0.05);
}

/* PREVIEW */
#preview {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 12px;
}

#preview img {
    width: 75px;
    height: 75px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: 0.2s;
}

#preview img:hover {
    transform: scale(1.05);
}

/* BUTTON */
button {
    margin-top: 14px;
    padding: 12px;
    border-radius: 12px;
    border: none;
    font-size: 15px;
    color: white;
    background: linear-gradient(135deg, #4f8cff, #376dff);
    cursor: pointer;
    transition: 0.25s;
    position: relative;
    overflow: hidden;
}

button:hover {
    box-shadow: 0 12px 25px rgba(55,109,255,0.3);
}

button:active {
    transform: scale(0.98);
}

/* shine */
button::after {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.25);
    transform: skewX(-20deg);
    transition: 0.4s;
}

button:hover::after {
    left: 120%;
}

/* FEED */
.post {
    background: rgba(255,255,255,0.95);
    border-radius: 16px;
    padding: 14px;
    margin-bottom: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
}

/* TEXT */
.post-text {
    margin-bottom: 10px;
    font-size: 14px;
}

/* IMAGE GRID */
.post-images {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
    gap: 6px;
}

.post-images img {
    width: 100%;
    border-radius: 10px;
    object-fit: cover;
    transition: 0.2s;
}

.post-images img:hover {
    transform: scale(1.03);
}
</style>
</head>

<body>

<div class="wrapper">

    <!-- COMPOSER -->
    <div class="card">
        <div class="title">Create Post</div>

        <textarea id="content" placeholder="What's on your mind?"></textarea>

        <div class="dropzone" id="dropZone">
            Drag • Drop • Paste • Click to upload images
        </div>

        <input type="file" id="fileInput" multiple hidden>

        <div id="preview"></div>

        <button onclick="upload()">Publish Post</button>
    </div>

    <!-- FEED -->
    <div id="feed"></div>

</div>

<script>
let files = [];

const dz = document.getElementById("dropZone");
const fi = document.getElementById("fileInput");

/* click */
dz.onclick = () => fi.click();
fi.onchange = e => addFiles(e.target.files);

/* drag */
dz.addEventListener("dragover", e => e.preventDefault());
dz.addEventListener("drop", e => {
    e.preventDefault();
    addFiles(e.dataTransfer.files);
});

/* paste */
document.addEventListener("paste", e => {
    let items = e.clipboardData.items;
    let arr = [];

    for (let i of items) {
        if (i.type.includes("image")) {
            arr.push(i.getAsFile());
        }
    }

    addFiles(arr);
});

/* preview */
function addFiles(filesList) {
    for (let f of filesList) {
        files.push(f);

        let r = new FileReader();
        r.onload = e => {
            let img = document.createElement("img");
            img.src = e.target.result;
            preview.appendChild(img);
        };
        r.readAsDataURL(f);
    }
}

/* upload */
function upload() {
    let fd = new FormData();
    fd.append("content", document.getElementById("content").value);

    files.forEach(f => fd.append("images[]", f));

    fetch("upload.php", { method: "POST", body: fd })
    .then(() => {
        files = [];
        preview.innerHTML = "";
        content.value = "";
        load();
    });
}

/* load feed */
function load() {
    fetch("fetch_posts.php")
    .then(r => r.json())
    .then(data => {
        let feed = document.getElementById("feed");
        feed.innerHTML = "";

        data.forEach(p => {
            let div = document.createElement("div");
            div.className = "post";

            div.innerHTML = `
                <div class="post-text">${p.content}</div>
                <div class="post-images">
                    ${p.images.map(i => `<img src="${i}">`).join("")}
                </div>
            `;

            feed.appendChild(div);
        });
    });
}

load();
</script>

</body>
</html>