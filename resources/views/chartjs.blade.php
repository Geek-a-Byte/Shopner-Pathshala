<!doctype html>
<html>

<head>
    <title>Bar Chart</title>
    <script src="http://www.chartjs.org/dist/2.7.3/Chart.bundle.js"></script>
    <script src="http://www.chartjs.org/samples/latest/utils.js"></script>
    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
    </style>
</head>

<body>
    <div id="container" style="width: 75%;">
        <canvas id="canvas"></canvas>
    </div>


    <script>
        const labels = <?php echo json_encode($Months); ?>;
        const data = {
            labels: labels,
            datasets: [{
                label: 'My First Dataset',
                data: <?php echo json_encode($Data); ?>,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };

        const config = {
            type: 'line',
            data: data,
        };
        var ctx = document.getElementById('canvas').getContext('2d');
        new Chart(ctx, config);
    </script>
</body>

</html>