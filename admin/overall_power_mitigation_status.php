<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "power_consumption";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn)
{
  die("Connection failed: " . mysqli_connect_error());
}
else
{
  $sql = "select ur.id as id, ur.name as name, ur.transformer_id as transformer_id, ur.consumer_no as consumer_no, ur.phone_no as phone_no, 
  ur.aadhar_no as aadhar_no, ur.address as address, ur.units as units, ur.amount as amount, max(pu.voltage) as voltage, 
  pu.created_at as created_at from user_registration ur 
  join power_usage pu on pu.consumer_no = ur.consumer_no
  group by pu.consumer_no;";

}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Chart 3</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="chart3.css" rel="stylesheet" type="text/css" />
</head>
<body class="">
<div class="sidenav">
  <a href="about.php">About</a>
  <a href="overall_power_usage_across_consumers.php">Overall Power Usage (Consumer)</a>
  <a href="overall_power_usage_across_transformers.php">Overall Power Usage (Transformer)</a>
  <a href="overall_power_mitigation_status.php">Power Mitigation Stats</a>
  <button class="button" onclick='location.href="../index.html"'>Back To Main</button>
</div>

<div class="main">
  <div class="container">
    <h3>PMTC User Info</h3>

<table class="container">
    <tbody>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Phone No</th>
        <th>Aadhar no</th>
        <th>Address</th>
        <th>Consumer No</th>
        <th>Transformer ID</th>
        <th>Units</th>
        <th>Reading</th>
        <th>Voltage</th>
        <th>Created At</th>
    </tr>
  <?php
if ($result = mysqli_query($conn, $sql)) {
    while ($row = $result->fetch_assoc()) {
        if($row['voltage'] >= 1.1){
        echo 
        '<tr class="danger">
        <td>'.$row['id'].'</td>        
        
        <td>'.$row['name'].'</td>        
        
        <td>'.$row['phone_no'].'</td>
        
        <td>'.$row['aadhar_no'].'</td>

        <td>'.$row['address'].'</td>
        
        <td>'.$row['consumer_no'].'</td>

        <td>'.$row['transformer_id'].'</td>        
        
        <td>'.$row['units'].'</td>
        
        <td>'.$row['amount'].'</td>

        <td>'.$row['voltage'].'</td>

        <td>'.$row['created_at'].'</td>
        </tr>';
        } else {
            echo 
        '<tr>
        <td>'.$row['id'].'</td>        
        
        <td>'.$row['name'].'</td>        
        
        <td>'.$row['phone_no'].'</td>
        
        <td>'.$row['aadhar_no'].'</td>

        <td>'.$row['address'].'</td>
        
        <td>'.$row['consumer_no'].'</td>

        <td>'.$row['transformer_id'].'</td>        
        
        <td>'.$row['units'].'</td>
        
        <td>'.$row['amount'].'</td>

        <td>'.$row['voltage'].'</td>

        <td>'.$row['created_at'].'</td>
        </tr>';
        }
    }
    $result->free();
} 
?>  
</tbody>
</table>
</div>
</div>
</body>
</html>

