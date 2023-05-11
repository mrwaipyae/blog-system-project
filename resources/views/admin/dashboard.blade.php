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
ksort($data);
$data = array_values($data);
@endphp

<!-- Rest of the dashboard content -->
<!-- Add input fields for start and end date selection -->
<input type="date" id="start_date">
<input type="date" id="end_date">
<button onclick="updateChart()">Update Chart</button>
<div id="chart_div" style="width: 40%; height: 500px;"></div>
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

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }

    // Update chart with data within selected date range
    function updateChart() {
        // Retrieve start and end dates from input fields
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;

        // Retrieve all data from PHP array
        var allData = <?php echo json_encode($data); ?>;

        // Initialize filtered data array with headers
        var filteredData = [];
        filteredData.push(allData[0]);

        // Loop through all data and add to filtered data if within date range
        for (var i = 1; i < allData.length; i++) {
            if (new Date(allData[i][0]) >= new Date(startDate) && new Date(allData[i][0]) <= new Date(endDate)) {
                filteredData.push(allData[i]);
            }
        }

        // Create chart with filtered data or display message if there are no posts
        if (filteredData.length > 1) {
            var data = google.visualization.arrayToDataTable(filteredData);
            var options = {
                title: 'Total Posts by Month'
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        } else {
            document.getElementById('chart_div').innerHTML = "No posts for the selected date range.";
        }
    }
</script>
