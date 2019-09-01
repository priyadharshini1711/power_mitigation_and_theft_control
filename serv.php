<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "power_consumption";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM session";
$result = $conn->query($sql);
$jsonArray=array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       // echo "id: " . $row["userid"]. " - Name: " . $row["transformerid"]. " " . $row["voltage"]. "<br>";
        $jsonArrayItem = array();
        $jsonArrayItem['label'] = $row['userid'];
        $jsonArrayItem['value'] = $row['voltage'];
        //append the above created object into the main array.
        array_push($jsonArray, $jsonArrayItem);
    }
} else {
    //echo "0 results";
}
$conn->close();

    //output the return value of json encode using the echo function.
    echo json_encode($jsonArray);
?> 