  @extends('layouts.auth')
  @section('content')
  <!doctype html>
  <html lang="en">

  <head>
    <title>Result Bar Chart </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages': ['corechart', 'bar'],
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Result_id', 'Score'],
          @php
          foreach($results as $result) {
            echo "['".$result -> result_id.
            "', ".$result -> score.
            "],";
          }
          @endphp
        ]);

        var line_pie_options = {
          title: 'Line Graph | Scores',
          subtitle: 'Score, and Test: @php echo $results[0]->created_at @endphp',
          curveType: 'function',
          legend: {
            position: 'bottom'
          }
        };
        var bar_options = {
          chart: {
            title: 'Bar Graph | Scores',
            subtitle: 'Score, and Test: @php echo $results[0]->created_at @endphp',
          },
          bars: 'vertical'
        };

        var line_chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        var pie_chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        var bar_chart = new google.charts.Bar(document.getElementById('barchart_material'));
        line_chart.draw(data, line_pie_options);
        pie_chart.draw(data, line_pie_options);
        bar_chart.draw(data, google.charts.Bar.convertOptions(bar_options));

      }
    </script>

  </head>

  <body>
    <div class="container">
      <div id="curve_chart" style="width: 900px; height: 500px"></div>
      <div id="barchart_material" style="width: 900px; height: 500px"></div>
      <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
    </div>

  </body>

  </html>
  @endsection