<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head><title>Chart 2</title>
<link href="chart3.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
 google.charts.load('current', {'packages':['corechart']});
     // Draw the pie chart when Charts is loaded.
      google.charts.setOnLoadCallback(draw_my_chart);
      // Callback that draws the pie chart
      function draw_my_chart() {
        // Create the data table .
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'transformer_id');
        data.addColumn('number', 'Nos');
		for(i = 0; i < my_2d.length; i++)
    data.addRow([my_2d[i][0], parseInt(my_2d[i][1])]);
// above row adds the JavaScript two dimensional array data into required chart format
    var options = {title:'Percentage of power distributed by the Transformers',
                       pieHole: 0.5,
					   'width':600,
                       'height':500,
			   
					   };

        // Instantiate and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
</script>
</head>
<body >
<?php
$connection = mysqli_connect("localhost", "root", "", "power_consumption");  
if($stmt = $connection->query("SELECT transformer_id, sum(voltage)  FROM power_usage GROUP BY transformer_id ")){

$php_data_array = Array(); // create PHP array
 
while ($row = $stmt->fetch_row()) {
   $php_data_array[] = $row; // Adding to array
   }
}else{
echo $connection->error;
}
//print_r( $php_data_array);
// You can display the json_encode output here. 

// Transfor PHP array to JavaScript two dimensional array 
echo "<script>
        var my_2d = ".json_encode($php_data_array)."
</script>";
?>


</body>
<div class="sidenav">
  <a href="about.php">About</a>
  <a href="overall_power_usage_across_consumers.php">Overall Power Usage (Consumer)</a>
  <a href="overall_power_usage_across_transformers.php">Overall Power Usage (Transformer)</a>
  <a href="overall_power_mitigation_status.php">Power Mitigation Stats</a>
  <button class="button" onclick='location.href="../index.html"'>Back To Main</button>
</div>  
<div class="main">  
                <h3 align="center">Overall Transformers Database</h3>  
                <br />  
                <div id="donutchart" style="width: 900px; height: 500px;"></div>  
           </div>  


</html>







