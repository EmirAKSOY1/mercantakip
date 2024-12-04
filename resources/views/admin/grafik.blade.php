<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ApexCharts Example</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>

<div id="chart"></div>

<script>
    var options = {
        chart: {
            type: 'line',
            height: 350
        },
        series: [{
            name: 'Sales',
            data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
        }],
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
        },
        title: {
            text: 'Monthly Sales Data',
            align: 'center'
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>

</body>
</html>
