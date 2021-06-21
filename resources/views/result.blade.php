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

  <style>
    .space {
      margin-left: 100px;
      margin-right: 100px;
      /* padding-left: 100px; */
    }

    .flex {
      display: flex;
      flex-wrap: nowrap;
      background-color: DodgerBlue;
    }
  </style>
</head>
<?php
$guardian = DB::table('guardians')->where('user_id', Auth::user()->id)->first();
$users = DB::table('childs')->where('acct_holder_id', $guardian->acct_holder_id)->get();


function convertDataToChartForm($data)
{
  var_dump($data);
  $newData = array();
  $firstLine = true;

  foreach ($data as $dataRow) {
    var_dump($dataRow);
    if ($firstLine) {
      $newData[] = array_keys($dataRow);
      $firstLine = false;
    }

    $newData[] = array_values($dataRow);
  }

  return $newData;
}

?>

<body>

  @foreach ($users as $user)
  <div class="space">
    <h3>Child ID : <?= $user->child_id ?> Results</h3>
  </div>

  <?php

  /*
  select CI.child_id,course_name,course_level,course_code,test_code,pre_requisite,score from courses C
inner join child_takes_course CI USING(course_code)
inner join tests T USING(course_code)
inner join results R USING(test_code)
where CI.child_id=1 and R.child_id=1 
  */
  $result_of_child = DB::table('courses')
    ->join('child_takes_course', 'courses.course_code', '=', 'child_takes_course.course_code')
    ->join('tests', 'tests.course_code', '=', 'child_takes_course.course_code')
    ->join('results', 'results.test_code', '=', 'tests.test_code')
    ->select('courses.course_name', 'tests.test_code', 'results.score')
    ->orderBy('courses.course_name')
    ->where('child_takes_course.child_id', '=', $user->child_id)
    ->where('results.child_id', '=', $user->child_id)
    ->get();
  $result[] = ['course_name', 'score'];
  foreach ($result_of_child as $key => $value) {
    // echo $value->course_name .  $value->score . '</br>';
    $result[++$key] = [$value->course_name, (int)$value->score];
  }
  ?>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {
      packages: ["corechart", "bar"]
    });
    google.charts.setOnLoadCallback(drawChart);


    function drawChart() {
      var result = <?php echo json_encode($result); ?>;
      console.log(result);
      var data = google.visualization.arrayToDataTable(result);
      console.log(data);
      var line_options = {
        title: 'Line Graph | Scores',
        subtitle: 'Score, and Test:',
        curveType: 'function',
        legend: {
          position: 'bottom'
        }
      };
      var pie_options = {
        title: 'Pie Graph | Scores',
        subtitle: 'Score, and Test:',
        curveType: 'function',
        is3D: true,
        legend: {
          position: 'bottom'
        }

      };
      var bar_options = {
        chart: {
          title: 'Bar Graph | Scores',
          subtitle: 'Score, and Test:',
        },
        bars: 'vertical'
      };

      var line_chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
      // var pie_chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
      var bar_chart = new google.charts.Bar(document.getElementById('barchart_material'));
      line_chart.draw(data, line_options);
      // pie_chart.draw(data, pie_options);
      bar_chart.draw(data, google.charts.Bar.convertOptions(bar_options));

    }
  </script>
  <!-- <div class="space">
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
  </div> -->
  <div class="space flex">
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
    <div id="barchart_material" style="width: 900px; height: 500px"></div>
  </div>
  <div class="space">

  </div>




  @endforeach
  </div>

</body>

</html>
@endsection