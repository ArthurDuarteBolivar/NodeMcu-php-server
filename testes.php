<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<canvas class="graph "  id="myChart"></canvas>
<script>
    const data = {
  labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6'],
  datasets: [
    {
      label: 'Dataset',
      data: Utils.numbers({count: 6, min: -100, max: 100}),
      borderColor: Utils.CHART_COLORS.red,
      fill: false,
      stepped: true,
    }
  ]
};
const config = {
  type: 'line',
  data: data,
  options: {
    responsive: true,
    interaction: {
      intersect: false,
      axis: 'x'
    },
    plugins: {
      title: {
        display: true,
        text: (ctx) => 'Step ' + ctx.chart.data.datasets[0].stepped + ' Interpolation',
      }
    }
  }
};
const myChart = new Chart(document.getElementById('myChart'),config);
</script>
</body>
</html>