<?php  
 $connect = mysqli_connect("localhost", "root", "", "power_consumption");  
 $query = "SELECT `consumer_no`, sum(voltage) as voltage FROM `power_usage` GROUP BY consumer_no ";  
 $result = mysqli_query($connect, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Chart 1</title>  
           <link href="chart3.css" rel="stylesheet" type="text/css" />
           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['consumer_no', 'voltage'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["consumer_no"]."', ".$row["voltage"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Percentage of power consumed by the Consumers',  
                      is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script>  
      </head>  
      <body>  
      <div class="sidenav">
  <a href="about.php">About</a>
  <a href="overall_power_usage_across_consumers.php">Overall Power Usage (Consumer)</a>
  <a href="overall_power_usage_across_transformers.php">Overall Power Usage (Transformer)</a>
  <a href="overall_power_mitigation_status.php">Power Mitigation Stats</a>
  <button class="button" onclick='location.href="../index.html"'>Back To Main</button>
</div>  
           <div class="main">  
                <h3 align="center">Overall Consumers Database</h3>  
                <br />  
                <div id="piechart" style="width: 900px; height: 500px;"></div>  
           </div>  
      </body>  
 </html>  