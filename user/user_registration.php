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
    if (isset($_POST["name"]))
    {
        $name = $_POST["name"];
        $phone_no = $_POST["phone_no"];
        $aadhar_no = $_POST["aadhar_no"];
        $consumer_no = $_POST["consumer_no"];
        $address = $_POST["address"];
        $postal_code = $_POST["postal_code"];
        $district = $_POST["district"];
        $zone = $_POST["zone"];
        $transformer_id = $_POST["transformerId"];
        $errorMessage = array();
        $successMessage = "";

        if (empty($name) || empty($phone_no) || empty($aadhar_no) || empty($consumer_no) || empty($address))
        {
            array_push($errorMessage, "empty values not allowed");
        }

        $sql = "select consumer_no from user_registration";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0)
        {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result))
            {
                if (strcmp($row['consumer_no'], $consumer_no) == 0)
                {
                    array_push($errorMessage, "User already exists");
                    break;
                }
            }
        }

        if (count($errorMessage) == 0)
        {
            $sql = "insert into user_registration (name, phone_no, aadhar_no, consumer_no, address, transformer_id) values ('$name', '$phone_no', '$aadhar_no', '$consumer_no', '$address', '$transformer_id')";

            if (mysqli_query($conn, $sql))
            {
                $successMessage = "New record created successfully";
                header("Location: thankyou.php");
                exit();
            }
            else
            {
                array_push($errorMessage, mysqli_error($conn));
            }
        }
    }
}

?>
<html>
<head>
<title>User Register</title>
<link href="user_registration.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <form name="frmRegistration" method="post" action="">
        <div class="demo-table">
        <div class="form-head">Register</div>
            
<?php
if (empty($errorMessage) && !empty($successMessage))
{
?>	
            <div class="success-message">
            <?php
    echo $successMessage . "<br/>";
?>
            </div>
<?php
}
?>

<?php
if (!empty($errorMessage) && is_array($errorMessage))
{
?>	
            <div class="error-message">
            <?php
    foreach ($errorMessage as $message)
    {
        echo $message . "<br/>";
    }
?>
            </div>
<?php
}
?>
            <div class="field-column">
                <label>Name</label>
                <div>
                    <input type="text" class="demo-input-box"
                        name="name"
                        value="">
                </div>
            </div>
            
            <div class="field-column">
                <label>Phone No</label>
                <div><input type="text" class="demo-input-box"
                    name="phone_no" value=""></div>
            </div>
            <div class="field-column">
                <label>Aadhar No</label>
                <div>
                    <input type="text" class="demo-input-box"
                        name="aadhar_no" value="">
                </div>
            </div>
            <div class="field-column">
                <label>Consumer Number</label>
                <div>
                    <input type="text" class="demo-input-box"
                        name="consumer_no"
                        value="">
                </div>

            </div>
            <div class="field-column">
                <label>Address</label>
                <div>
                    <input type="text" class="demo-input-box"
                        name="address"
                        value="">
                </div>

            </div>
            
                <div class="field-column">
                <label>Postal Code</label>
                <?php
                echo "<select name='postal_code'>";
                echo "<option>-- Select Item --</option>";        
    $query = "SELECT distinct(postal_code) FROM `distribution`";
    $result = mysqli_query($conn, $query);
    while($row=mysqli_fetch_array($result)){                                                 
       echo "<option value='".$row['postal_code']."'>".$row['postal_code']."</option>";
    }
    echo "</select>";
?>
                </div>
                <div class="field-column">
                <label>District</label>
                <?php
                echo "<select name='district'>";
                echo "<option>-- Select Item --</option>";        
    $query = "SELECT distinct(district) FROM `distribution`";
    $result = mysqli_query($conn, $query);
    while($row=mysqli_fetch_array($result)){                                                 
       echo "<option value='".$row['district']."'>".$row['district']."</option>";
    }
    echo "</select>";
?>
                </div>
                <div class="field-column">
                <label>Zone</label>
                <?php
                echo "<select name='zone'>";
                echo "<option>-- Select Item --</option>";        
    $query = "SELECT distinct(zone) FROM `distribution`";
    $result = mysqli_query($conn, $query);
    while($row=mysqli_fetch_array($result)){                                                 
       echo "<option value='".$row['zone']."'>".$row['zone']."</option>";
    }
    echo "</select>";
?>
                </div>
                <div class="field-column">
                <label>Transformer ID</label>
                <?php
                echo '<select name="transformerId">';
                echo "<option>-- Select Item --</option>";        
    $query = "SELECT distinct(transformer_id) FROM `distribution`";
    $result = mysqli_query($conn, $query);
    while($row=mysqli_fetch_array($result)){                                                 
       echo "<option name='transformerId' value='".$row['transformer_id']."'>".$row['transformer_id']."</option>";
    }
    echo "</select>";
?>
            </div>
            <div class="field-column">
                <div class="terms">
                    <input type="checkbox" name="terms"> I accept terms
                    and conditions
                </div>
                <div>
                    <input type="submit"
                        name="register-user" value="Register"
                        class="btnRegister">
                </div>
            </div>
        </div>
    </form>
    <div class="button-container">
  <div class="center">
  <button onclick='location.href="user_login.php"'>Back</button>
  </div>
</div>
</body>
</html>
