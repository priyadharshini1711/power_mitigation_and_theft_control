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
  $consumer_no = $_GET["consumer_no"];
  $sql = "select * from user_registration where consumer_no = $consumer_no";

  $power_theft = "select voltage from power_usage where consumer_no = $consumer_no";

  $power_theft_result = mysqli_query($conn, $power_theft);

  $power_theft_alert = 0;

  while($row = mysqli_fetch_array($power_theft_result)){
    if($row[0] > 1.5 ){
      $power_theft_alert = 1;
      break;
    }
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>User</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="user.css" rel="stylesheet" type="text/css" />
</head>
<body class="container">

<h3>PMTC User Info</h3>

<table class="container">
  <?php
if ($result = mysqli_query($conn, $sql)) {
    while ($row = $result->fetch_assoc()) {
        echo 
        '<tr>
        <td>Id</td>
        <td>'.$row['id'].'</td>
        </tr>
        <tr>
        <td>Name</td>
        <td>'.$row['name'].'</td>
        </tr>
        <tr>
        <td>Transformer Id</td>
        <td>'.$row['transformer_id'].'</td>
        </tr>
        <tr>
        <td>Phone No</td>
        <td>'.$row['phone_no'].'</td>
        </tr>
        <tr>
        <td>Aadhar No</td>
        <td>'.$row['aadhar_no'].'</td>
        </tr>
        <tr>
        <td>Consumer No</td>
        <td>'.$row['consumer_no'].'</td>
        </tr>
        <tr>
        <td>Address</td>
        <td>'.$row['address'].'</td>
        </tr>
        <tr>
        <td>Reading Units</td>
        <td>'.$row['units'].'</td>
        </tr>
        <tr>
        <td>Amount</td>
        <td>'.$row['amount'].'</td>
        </tr>';
    }
    $result->free();
} 
?>  
</table>
<?php
if($power_theft_alert == 1)
echo '
<div class="w3-panel w3-red">
  <h3>Danger!</h3>
  <p align="center">Your power consumption has been tampered.</p>
</div> '
?>
</body>
</html>

