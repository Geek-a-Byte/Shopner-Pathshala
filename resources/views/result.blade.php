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
  <script>
    var postJquery = [];
  </script>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    input[type=text],
    input[type=textarea],
    input[type=number],
    input[type=email],
    input[type=phone],
    select,
    textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
    }

    label {
      padding: 12px 12px 12px 0;
      display: inline-block;
    }

    input[type=submit] {
      background-color: #04AA6D;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      float: left;

    }

    input[type=submit]:hover {
      background-color: #45a049;
    }

    .container {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 50px;
    }

    .col-25 {
      float: left;
      width: 25%;
      margin-top: 6px;
    }

    .col-75 {
      float: left;
      width: 75%;
      margin-top: 6px;
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    .centerheader {
      text-align: center;
      margin-bottom: 20px;
    }

    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {

      .col-25,
      .col-75,
      input[type=submit] {
        width: 100%;
        margin-top: 0;
      }
    }

    .space {
      margin-left: 20px;
      margin-right: 20px;
      padding-top: 10px;
      padding-bottom: 20px;
    }

    .flex {
      display: flex;
      flex-wrap: nowrap;
      /* background-color: DodgerBlue; */
    }
  </style>
</head>

<body>
  <div>
    @if(session()->has('message'))
    <div class="alert alert-warning">
      {{ session()->get('message') }}
    </div>
    @endif
  </div>
  <div class="container">
    <div class="row">
      <form method="post" action="{{ route('show.result.graph') }}">
        @csrf
        <div class="row">
          <div class="col-25">
            <label for="childID">Give Child ID</label>
          </div>
          <div class="col-75">
            <input type="number" id="name" name="child_id">
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="form-group">
            <input type='submit' value='generate result graph'>
          </div>
        </div>
        <hr>
      </form>
    </div>
  </div>

  @isset($data)
  <?php
  // $result[] = array();
  include public_path('includes/connection.php');
  $sql = "SELECT course_name,score from courses C
          inner join child_takes_course CI USING(course_code)
          inner join tests T USING(course_code)
          inner join results R USING(test_code)
          where CI.child_id=:child_id and R.child_id=:child_id order BY C.course_name";
  $stid = oci_parse($conn, $sql);
  oci_bind_by_name($stid, ":child_id", $data);
  oci_execute($stid);
  $data = array();
  $i = 0;
  while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    $data[] = $row;
  }
  if (count($data) == 0) {
    echo '<h5 style="padding-left:15px;">' . "no result found" . '</h5>';
  } else {
    // var_dump($data);
    $key = 0;
    $result[] = ['course_name', 'score'];
    foreach ($data as $row) {
      $pair_arr = array();
      $parr_idx = 0;
      foreach ($row as $k => $v) {
        // echo $k . $v;
        if ($k == "SCORE")
          array_push($pair_arr, (int)$v);
        else
          array_push($pair_arr, $v);
        // $pair_arr[++$parr_idx] = [$k, $v];
      }
      $result[++$key] = $pair_arr;
    }
    // var_dump($result);
  }
  ?>

  <script type="text/javascript">
    google.charts.load("current", {
      packages: ["corechart", "bar"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var result = <?php if (isset($result) != 0) {
                      echo json_encode($result);
                    } ?>;
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
  <div class="space flex">
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
    <div id="barchart_material" style="width: 900px; height: 500px"></div>
  </div>
  <div class="space">
    <?php
    unset($result);
    $result[] = array();
    ?>

  </div>
  @endisset
</body>

</html>
@endsection