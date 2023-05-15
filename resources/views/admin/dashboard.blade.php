@extends('admin.layouts.master')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" ><a href="#" class="fw-bold">Admin</a></li>
      <li class="breadcrumb-item active" aria-current="page"><span class="fw-bold">Dashboard<span></li>
    </ol>
  </nav>
<div class="row mb-3 py-5">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Posts</h5>
                <p class="card-text">{{ $postCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Users</h5>
                <p class="card-text">{{ $userCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Tags</h5>
                <p class="card-text">{{ $tagCount }}</p>
            </div>
        </div>
    </div>
</div>

@php
// Initialize empty data array
$data = array();
$data[] = array('Month', 'Posts');
// Loop through posts and add to data array if within date range
foreach ($posts as $post) {
    $month = date('F Y', strtotime($post->date));
    if (!isset($data[$month])) {
        $data[$month] = array($month, 0);
    }
    $data[$month][1] += floatval($post->total);
}
// Sort data array by month in ascending order
$data = array_values($data);
@endphp

<!-- Add input fields for start and end date selection -->
<input type="date" id="start_date">
<input type="date" id="end_date">
<button class="btn btn-dark" onclick="updateChart()">Update Chart</button>
<div class="row">
    <div class="col-md-6">
        <div id="column_chart_div" style="width: 100%; height: 500px;"></div>
    </div>
    <div class="col-md-6">
        <div id="table_chart_div" style="width: 100%; height: 500px;"></div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    // Initialize chart with all data
    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo json_encode($data); ?>);
        var options = {
            title: 'Total Posts by Month'
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('column_chart_div'));
        chart.draw(data, options);
        var table = new google.visualization.Table(document.getElementById('table_chart_div'));
        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
    }

    // Update chart with data within selected date range
    function updateChart() {
        // Retrieve start and end dates from input fields
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;
        var date1 = new Date(startDate);
        var date2 = new Date(endDate);
        var formattedStartDate = date1.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
        var formattedEndDate = date2.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
        console.log(formattedStartDate,formattedEndDate);
        // Retrieve all data from PHP array
        var allData = <?php echo json_encode($data); ?>;
        
        // Initialize filtered data array with headers
        var filteredData = [];
        filteredData.push(allData[0]);
        

        // Loop through all data and add to filtered data if within date range
        for (var i = 0; i < allData.length; i++) {
            if ((new Date(allData[i][0]) >= new Date(formattedStartDate)) && (new Date(allData[i][0]) <= new Date(formattedStartDate))) {
                filteredData.push(allData[i]);
            }
        }
        console.log(filteredData);
       

        // Create chart with filtered data or display message if there are no posts
        if (filteredData.length > 1) {
            var data = google.visualization.arrayToDataTable(filteredData);
            var options = {
                title: 'Total Posts by Month'
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('column_chart_div'));
            chart.draw(data, options);
        } else {
            document.getElementById('column_chart_div').innerHTML = "No posts for the selected date range.";
        }
    }
</script>



@endsection

