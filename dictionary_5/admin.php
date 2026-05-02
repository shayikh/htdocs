<!DOCTYPE html>
<html>
<head>
    <title>Dictionary Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px;
        }

        .box {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        button {
            padding: 10px 15px;
            margin-right: 5px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        h2 {
            margin-top: 0;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>📊 Trending Words Analytics</h2>

    <button onclick="loadData('today')">Today</button>
    <button onclick="loadData('week')">Weekly</button>
    <button onclick="loadData('month')">Monthly</button>

    <canvas id="chart" height="100"></canvas>
</div>

<div class="box">
    <h2>🔥 Top 10 Words Table</h2>
    <div id="table"></div>
</div>

<script>
let chart;

function loadData(type) {

    fetch("stats.php?type=" + type)
        .then(res => res.json())
        .then(data => {

            // TABLE
            let html = "<table><tr><th>Word</th><th>Search Count</th></tr>";

            data.forEach(item => {
                html += `<tr>
                    <td>${item.word}</td>
                    <td>${item.count}</td>
                </tr>`;
            });

            html += "</table>";
            document.getElementById("table").innerHTML = html;

            // CHART DATA
            let labels = data.map(i => i.word);
            let values = data.map(i => i.count);

            if (chart) chart.destroy();

            chart = new Chart(document.getElementById("chart"), {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Search Count",
                        data: values
                    }]
                },
                options: {
                    responsive: true
                }
            });

        });
}

// default load
loadData("today");
</script>

</body>
</html>